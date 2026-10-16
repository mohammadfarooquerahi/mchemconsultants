<?php
/**
 * MChem Consultants - inc/whatsapp-form.php
 *
 * Handles the booking/consultation form backend:
 *  1. AJAX handler for saving client inquiries to WP database
 *  2. HTML email notification to admin (mchemconsultants2@gmail.com)
 *  3. Admin Dashboard table under WP Admin > Bookings with WhatsApp action buttons
 *  4. Returns WhatsApp prefilled URL for instant client connection
 *
 * @package mchemconsultants
 */

defined( 'ABSPATH' ) || exit;

add_action( 'wp_ajax_mchem_booking_submit',        'mchem_handle_booking_submit' );
add_action( 'wp_ajax_nopriv_mchem_booking_submit', 'mchem_handle_booking_submit' );

function mchem_handle_booking_submit() {

    // 1. Verify CSRF Nonce
    if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['nonce'] ) ), 'mchem_booking_nonce' ) ) {
        wp_send_json_error( array( 'message' => esc_html__( 'Security validation failed. Please refresh and try again.', 'mchemconsultants' ) ) );
    }

    // 2. Sanitize form input fields
    $name         = sanitize_text_field( wp_unslash( $_POST['name']         ?? '' ) );
    $email        = sanitize_email(      wp_unslash( $_POST['email']        ?? '' ) );
    $company      = sanitize_text_field( wp_unslash( $_POST['company']      ?? '' ) );
    $country_code = sanitize_text_field( wp_unslash( $_POST['country_code'] ?? '+92' ) );
    $phone        = sanitize_text_field( wp_unslash( $_POST['phone']        ?? '' ) );
    $service      = sanitize_text_field( wp_unslash( $_POST['service']      ?? 'General Inquiry' ) );
    $pref_date    = sanitize_text_field( wp_unslash( $_POST['pref_date']    ?? '' ) );
    $pref_time    = sanitize_text_field( wp_unslash( $_POST['pref_time']    ?? '' ) );
    $message      = sanitize_textarea_field( wp_unslash( $_POST['message'] ?? '' ) );

    // Handle File Upload
    $file_url = '';
    if ( ! empty( $_FILES['project_file']['name'] ) ) {
        // Need to load dependencies for wp_handle_upload if not already loaded (e.g. in frontend ajax)
        if ( ! function_exists( 'wp_handle_upload' ) ) {
            require_once ABSPATH . 'wp-admin/includes/file.php';
        }
        $upload_overrides = array( 'test_form' => false );
        $uploaded = wp_handle_upload( $_FILES['project_file'], $upload_overrides );
        if ( ! empty( $uploaded['url'] ) ) {
            $file_url = esc_url_raw( $uploaded['url'] );
        }
    }

    if ( ! empty( $phone ) ) {
        if ( strpos( $phone, '+' ) === 0 ) {
            $full_phone = $phone;
        } elseif ( $country_code !== '+' && ! empty( $country_code ) ) {
            $full_phone = $country_code . ' ' . $phone;
        } else {
            $full_phone = $phone;
        }
    } else {
        $full_phone = 'N/A';
    }

    // 3. Validation
    if ( empty( $name ) ) {
        wp_send_json_error( array( 'message' => esc_html__( 'Please provide your Full Name.', 'mchemconsultants' ) ) );
    }
    if ( empty( $email ) || ! is_email( $email ) ) {
        wp_send_json_error( array( 'message' => esc_html__( 'Please provide a valid Work Email address.', 'mchemconsultants' ) ) );
    }

    // 4. Save to Database
    $timestamp = current_time( 'mysql' );
    $submission = array(
        'id'        => uniqid( 'mchem_' ),
        'timestamp' => $timestamp,
        'name'      => $name,
        'email'     => $email,
        'company'   => $company ?: 'N/A',
        'phone'     => $full_phone,
        'service'   => $service,
        'pref_date' => $pref_date ?: 'Flexible',
        'pref_time' => $pref_time ?: 'Flexible',
        'message'   => $message ?: 'No message specified',
        'file'      => $file_url,
        'ip'        => sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ?? 'Unknown' ) ),
        'status'    => 'New',
    );

    $submissions = get_option( 'mchem_bookings', array() );
    $submissions[] = $submission;
    update_option( 'mchem_bookings', $submissions );

    // 5. Send Notification Email to Admin
    $admin_email = get_theme_mod( 'mchem_contact_email', 'mchemconsultants2@gmail.com' );
    $site_admin  = get_option( 'admin_email' );
    $to_emails   = array( $admin_email );
    if ( $site_admin && $site_admin !== $admin_email ) {
        $to_emails[] = $site_admin;
    }

    $subject = sprintf( '🚨 New Consultation Request: %s (%s)', $name, $service );

    $file_row = '';
    if ( $file_url ) {
        $file_row = "<tr><td style='padding:10px;border:1px solid #e2e8f0;background:#f8fafc;'><strong>Attached File:</strong></td><td style='padding:10px;border:1px solid #e2e8f0;'><a href='{$file_url}' target='_blank' style='color:#0284c7;font-weight:600;text-decoration:underline;'>Download / View File</a></td></tr>";
    }

    $email_content = "
    <div style='font-family:Plus Jakarta Sans, Inter, Arial, sans-serif;max-width:640px;margin:0 auto;padding:24px;border:1px solid #e2e8f0;border-radius:12px;background:#ffffff;'>
        <div style='border-bottom:2px solid #0284c7;padding-bottom:16px;margin-bottom:20px;'>
            <h2 style='margin:0;color:#0f172a;font-size:22px;'>New Consultation Request</h2>
            <p style='margin:4px 0 0 0;color:#64748b;font-size:14px;'>Submitted on mchemconsultants.com at {$timestamp}</p>
        </div>

        <table style='border-collapse:collapse;width:100%;font-size:14px;color:#334155;margin-bottom:24px;'>
            <tr><td style='padding:10px;border:1px solid #e2e8f0;background:#f8fafc;width:35%;'><strong>Client Name:</strong></td><td style='padding:10px;border:1px solid #e2e8f0;font-weight:600;color:#0f172a;'>{$name}</td></tr>
            <tr><td style='padding:10px;border:1px solid #e2e8f0;background:#f8fafc;'><strong>Work Email:</strong></td><td style='padding:10px;border:1px solid #e2e8f0;'><a href='mailto:{$email}' style='color:#0284c7;'>{$email}</a></td></tr>
            <tr><td style='padding:10px;border:1px solid #e2e8f0;background:#f8fafc;'><strong>Company / Org:</strong></td><td style='padding:10px;border:1px solid #e2e8f0;'>{$company}</td></tr>
            <tr><td style='padding:10px;border:1px solid #e2e8f0;background:#f8fafc;'><strong>Phone / WhatsApp:</strong></td><td style='padding:10px;border:1px solid #e2e8f0;font-weight:600;'>{$full_phone}</td></tr>
            <tr><td style='padding:10px;border:1px solid #e2e8f0;background:#f8fafc;'><strong>Service of Interest:</strong></td><td style='padding:10px;border:1px solid #e2e8f0;color:#0284c7;font-weight:600;'>{$service}</td></tr>
            <tr><td style='padding:10px;border:1px solid #e2e8f0;background:#f8fafc;'><strong>Preferred Schedule:</strong></td><td style='padding:10px;border:1px solid #e2e8f0;'>{$pref_date} ({$pref_time})</td></tr>
            <tr><td style='padding:10px;border:1px solid #e2e8f0;background:#f8fafc;'><strong>Project Scope:</strong></td><td style='padding:10px;border:1px solid #e2e8f0;line-height:1.6;'>" . nl2br( $message ) . "</td></tr>
            {$file_row}
        </table>

        <div style='text-align:center;padding-top:10px;'>
            <a href='" . admin_url( 'admin.php?page=mchem-bookings' ) . "' style='display:inline-block;padding:12px 24px;background:#0284c7;color:#ffffff;text-decoration:none;border-radius:8px;font-weight:700;font-size:14px;'>Manage Leads in WordPress Dashboard</a>
        </div>
    </div>
    ";

    $headers = array(
        'Content-Type: text/html; charset=UTF-8',
        'From: MChem Consultants <mchemconsultants2@gmail.com>',
        'Reply-To: ' . $name . ' <' . $email . '>',
    );

    wp_mail( $to_emails, $subject, $email_content, $headers );

    // Send confirmation email to client
    $client_subject = 'Consultation Request Received — MChem Consultants';
    $client_content = "
    <div style='font-family:Plus Jakarta Sans, Inter, Arial, sans-serif;max-width:600px;margin:0 auto;padding:24px;border:1px solid #e2e8f0;border-radius:12px;background:#ffffff;'>
        <h2 style='color:#0f172a;margin-top:0;'>Thank you for reaching out, {$name}!</h2>
        <p style='color:#475569;font-size:15px;line-height:1.6;'>
            We have received your engineering consultation request regarding <strong>{$service}</strong>. Our technical team at BIC MUET Jamshoro is reviewing your details and will contact you shortly via email or WhatsApp.
        </p>
        <p style='color:#475569;font-size:14px;'>For immediate assistance, feel free to contact us directly on WhatsApp at <strong>+92 332 0386271</strong>.</p>
        <hr style='border:none;border-top:1px solid #e2e8f0;margin:20px 0;'>
        <p style='color:#94a3b8;font-size:12px;margin:0;'>MChem Consultants · BIC MUET Jamshoro, Sindh, Pakistan</p>
    </div>
    ";
    wp_mail( $email, $client_subject, $client_content, array( 'Content-Type: text/html; charset=UTF-8', 'From: MChem Consultants <mchemconsultants2@gmail.com>' ) );

    // 6. Build WhatsApp URL with full details
    $whatsapp_number = get_theme_mod( 'mchem_whatsapp_number', '923320386271' );
    $clean_phone = preg_replace( '/[^0-9]/', '', $whatsapp_number );

    $wa_text  = "Hello MChem Consultants! 👋\n\n";
    $wa_text .= "I have just submitted a consultation request on mchemconsultants.com:\n\n";
    $wa_text .= "👤 *Name:* {$name}\n";
    $wa_text .= "📧 *Email:* {$email}\n";
    if ( $company && $company !== 'N/A' ) $wa_text .= "🏢 *Company:* {$company}\n";
    if ( $phone ) $wa_text .= "📞 *Phone:* {$full_phone}\n";
    $wa_text .= "⚙️ *Service:* {$service}\n";
    if ( $pref_date && $pref_date !== 'Flexible' ) $wa_text .= "📅 *Preferred Date:* {$pref_date} ({$pref_time})\n";
    if ( $message && $message !== 'No message specified' ) $wa_text .= "\n📝 *Project Scope:*\n{$message}\n";
    if ( $file_url ) $wa_text .= "\n📎 *Attached File:* {$file_url}\n";

    $wa_url = 'https://wa.me/' . $clean_phone . '?text=' . rawurlencode( $wa_text );

    wp_send_json_success( array(
        'message'      => esc_html__( 'Thank you! Your request has been sent via email and securely recorded. Connecting you directly on WhatsApp...', 'mchemconsultants' ),
        'whatsapp_url' => esc_url_raw( $wa_url ),
    ) );
}

/**
 * Register WordPress Admin Menu Page: Bookings
 */
add_action( 'admin_menu', 'mchem_register_bookings_admin_menu' );
function mchem_register_bookings_admin_menu() {
    add_menu_page(
        esc_html__( 'MChem Bookings & Leads', 'mchemconsultants' ),
        esc_html__( 'Bookings', 'mchemconsultants' ),
        'manage_options',
        'mchem-bookings',
        'mchem_render_bookings_admin_page',
        'dashicons-clipboard',
        6
    );
}

function mchem_render_bookings_admin_page() {
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_die( esc_html__( 'Unauthorized access.', 'mchemconsultants' ) );
    }

    // Handle delete action
    if ( isset( $_GET['action'], $_GET['sub_id'] ) && $_GET['action'] === 'delete' ) {
        check_admin_referer( 'mchem_delete_booking' );
        $del_id = sanitize_text_field( wp_unslash( $_GET['sub_id'] ) );
        $all = get_option( 'mchem_bookings', array() );
        $filtered = array_filter( $all, function( $item ) use ( $del_id ) {
            return ( ( $item['id'] ?? '' ) !== $del_id );
        } );
        update_option( 'mchem_bookings', array_values( $filtered ) );
        echo '<div class="notice notice-success is-dismissible"><p>Lead deleted successfully.</p></div>';
    }

    $submissions = get_option( 'mchem_bookings', array() );
    $submissions = array_reverse( $submissions );
    ?>
    <div class="wrap">
        <h1 style="display:flex;align-items:center;gap:10px;">
            <span class="dashicons dashicons-clipboard" style="font-size:32px;width:32px;height:32px;"></span>
            MChem Consultation Inquiries & Client Leads
        </h1>
        <p>All client submissions from the website consultation form are stored here. You can click to chat directly with clients on WhatsApp or reply via email.</p>

        <div style="margin-bottom:20px;display:flex;gap:15px;align-items:center;">
            <span style="font-weight:600;background:#0D1B3E;color:#fff;padding:6px 14px;border-radius:20px;">
                Total Leads: <?php echo count( $submissions ); ?>
            </span>
            <span style="color:#666;">Admin Notification Email: <strong><?php echo esc_html( get_theme_mod( 'mchem_contact_email', 'mchemconsultants2@gmail.com' ) ); ?></strong></span>
        </div>

        <?php if ( empty( $submissions ) ) : ?>
            <div style="background:#fff;padding:40px;text-align:center;border-radius:8px;border:1px solid #e2e8f0;">
                <span class="dashicons dashicons-inbox" style="font-size:48px;width:48px;height:48px;color:#94a3b8;"></span>
                <h3 style="margin-top:10px;color:#334155;">No consultation submissions yet</h3>
                <p style="color:#64748b;">New form submissions from your website will appear here in real-time.</p>
            </div>
        <?php else : ?>
            <table class="wp-list-table widefat fixed striped table-view-list" style="border-radius:8px;overflow:hidden;box-shadow:0 4px 12px rgba(0,0,0,0.05);">
                <thead>
                    <tr>
                        <th style="width:130px;">Date & Time</th>
                        <th>Client Details</th>
                        <th>Company & Phone</th>
                        <th>Service Requested</th>
                        <th>Preferred Schedule</th>
                        <th style="width:280px;">Project Scope</th>
                        <th style="width:140px;">Quick Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ( $submissions as $sub ) :
                        $sub_phone = preg_replace( '/[^0-9]/', '', $sub['phone'] ?? '' );
                        $sub_name  = $sub['name'] ?? 'Client';
                        $wa_direct = $sub_phone ? 'https://wa.me/' . $sub_phone . '?text=' . rawurlencode( "Hello {$sub_name}, thank you for contacting MChem Consultants regarding {$sub['service']}." ) : '';
                        $del_url   = wp_nonce_url( admin_url( 'admin.php?page=mchem-bookings&action=delete&sub_id=' . ( $sub['id'] ?? '' ) ), 'mchem_delete_booking' );
                    ?>
                    <tr>
                        <td style="color:#64748b;font-size:12px;">
                            <strong><?php echo esc_html( date( 'M d, Y', strtotime( $sub['timestamp'] ?? 'now' ) ) ); ?></strong><br>
                            <?php echo esc_html( date( 'h:i A', strtotime( $sub['timestamp'] ?? 'now' ) ) ); ?>
                        </td>
                        <td>
                            <strong style="color:#0f172a;font-size:14px;"><?php echo esc_html( $sub['name'] ?? '' ); ?></strong><br>
                            <a href="mailto:<?php echo esc_attr( $sub['email'] ?? '' ); ?>" style="color:#0284c7;font-size:13px;"><?php echo esc_html( $sub['email'] ?? '' ); ?></a>
                        </td>
                        <td>
                            <strong><?php echo esc_html( $sub['company'] ?? 'N/A' ); ?></strong><br>
                            <span style="color:#475569;"><?php echo esc_html( $sub['phone'] ?? 'N/A' ); ?></span>
                        </td>
                        <td>
                            <span style="background:#e0f2fe;color:#0369a1;padding:3px 8px;border-radius:4px;font-weight:600;font-size:12px;">
                                <?php echo esc_html( $sub['service'] ?? 'General' ); ?>
                            </span>
                        </td>
                        <td style="font-size:13px;color:#475569;">
                            <?php echo esc_html( $sub['pref_date'] ?? 'Flexible' ); ?><br>
                            <small style="color:#64748b;"><?php echo esc_html( $sub['pref_time'] ?? '' ); ?></small>
                        </td>
                        <td style="font-size:13px;color:#334155;">
                            <?php echo esc_html( $sub['message'] ?? '' ); ?>
                        </td>
                        <td>
                            <div style="display:flex;flex-direction:column;gap:6px;">
                                <?php if ( $sub_phone ) : ?>
                                <a href="<?php echo esc_url( $wa_direct ); ?>" target="_blank" class="button button-small" style="background:#22c55e;color:#fff;border:none;display:inline-flex;align-items:center;gap:4px;">
                                    Chat WhatsApp
                                </a>
                                <?php endif; ?>
                                <a href="<?php echo esc_url( $del_url ); ?>" class="button button-link-delete button-small" onclick="return confirm('Delete this inquiry record?');" style="color:#ef4444;">
                                    Delete
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
    <?php
}
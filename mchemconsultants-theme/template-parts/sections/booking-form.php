<?php
/**
 * MChem Consultants - template-parts/sections/booking-form.php
 *
 * Consultation & Booking Form Section matching NIW design:
 * - Split Header: [BOOK A CONSULTATION] + Editorial serif heading + Right description
 * - Elevated Form Panel with 2-column input rows, service selector, date/time pickers, textarea, consent checkbox, and solid cyan CTA button.
 *
 * @package mchemconsultants
 */
?>

<!-- ============================================================
     BOOKING & CONSULTATION FORM (NIW Matching)
     ============================================================ -->
<section id="booking" class="mchem-booking-section" aria-labelledby="mchem-booking-heading">
    <div class="mchem-container">

        <!-- Split Section Header (Matches Screenshot 1) -->
        <div class="mchem-booking-header" data-animate="fade-up">
            <div class="mchem-booking-header__left">
                <div class="mchem-booking-header__pill">
                    <span><?php esc_html_e( 'BOOK A CONSULTATION', 'mchemconsultants' ); ?></span>
                </div>
                <h2 id="mchem-booking-heading" class="mchem-booking-header__title">
                    Let's discuss what<br>
                    MChem can <span class="mchem-booking-header__highlight"><?php esc_html_e( 'engineer for you.', 'mchemconsultants' ); ?></span>
                </h2>
            </div>
            <div class="mchem-booking-header__right">
                <p class="mchem-booking-header__desc">
                    <?php esc_html_e( 'Share a few details about your engineering needs. Our faculty-guided team will review your request, securely store your project scope, and contact you to arrange a focused technical conversation.', 'mchemconsultants' ); ?>
                </p>
            </div>
        </div>

        <!-- Elevated Form Panel (Matches Screenshots 1, 2, 3) -->
        <div class="mchem-form-panel" data-animate="fade-up" data-delay="150">
            <form id="mchem-booking-form" class="mchem-form" novalidate>

                <?php wp_nonce_field( 'mchem_booking_nonce', 'mchem_nonce_field' ); ?>

                <!-- Row 1: Full name + Work email -->
                <div class="mchem-form__row mchem-form__row--2col">
                    <div class="mchem-form__group">
                        <label for="mchem-name" class="mchem-form__label"><?php esc_html_e( 'Full name', 'mchemconsultants' ); ?> <span class="mchem-form__req">*</span></label>
                        <input
                            type="text"
                            id="mchem-name"
                            name="name"
                            class="mchem-form__input"
                            placeholder="<?php esc_attr_e( 'Your full name', 'mchemconsultants' ); ?>"
                            required
                        >
                    </div>

                    <div class="mchem-form__group">
                        <label for="mchem-email" class="mchem-form__label"><?php esc_html_e( 'Work email', 'mchemconsultants' ); ?> <span class="mchem-form__req">*</span></label>
                        <input
                            type="email"
                            id="mchem-email"
                            name="email"
                            class="mchem-form__input"
                            placeholder="<?php esc_attr_e( 'you@company.com', 'mchemconsultants' ); ?>"
                            required
                        >
                    </div>
                </div>

                <!-- Row 2: Company + Phone with Flag Group -->
                <div class="mchem-form__row mchem-form__row--2col">
                    <div class="mchem-form__group">
                        <label for="mchem-company" class="mchem-form__label"><?php esc_html_e( 'Company / Organization', 'mchemconsultants' ); ?></label>
                        <input
                            type="text"
                            id="mchem-company"
                            name="company"
                            class="mchem-form__input"
                            placeholder="<?php esc_attr_e( 'Company name', 'mchemconsultants' ); ?>"
                        >
                    </div>

                    <div class="mchem-form__group">
                        <div class="mchem-form__label-row">
                            <label for="mchem-phone" class="mchem-form__label"><?php esc_html_e( 'Phone (WhatsApp)', 'mchemconsultants' ); ?></label>
                            <span class="mchem-form__opt"><?php esc_html_e( 'Optional', 'mchemconsultants' ); ?></span>
                        </div>
                        <div class="mchem-form__phone-group">
                            <div class="mchem-form__country-select" id="mchem-country-select">
                                <button type="button" class="mchem-form__country-btn" id="mchem-country-btn" aria-expanded="false">
                                    <span class="mchem-form__country-flag" id="mchem-country-flag">🇵🇰</span>
                                    <span class="mchem-form__country-code" id="mchem-country-code">+92</span>
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M6 9l6 6 6-6"/></svg>
                                </button>
                                <div class="mchem-form__country-dropdown" id="mchem-country-dropdown" hidden>
                                    <input type="text" class="mchem-form__country-search" id="mchem-country-search" placeholder="Search country..." autocomplete="off">
                                    <ul class="mchem-form__country-list" id="mchem-country-list" role="listbox"></ul>
                                </div>
                            </div>
                            <input type="hidden" name="country_code" id="mchem-country-code-input" value="+92">
                            <input
                                type="tel"
                                id="mchem-phone"
                                name="phone"
                                class="mchem-form__input mchem-form__input--phone"
                                placeholder="<?php esc_attr_e( 'Enter phone number', 'mchemconsultants' ); ?>"
                            >
                        </div>
                    </div>
                </div>

                <!-- Row 3: Interested in (Select a service dropdown) -->
                <div class="mchem-form__group">
                    <label for="mchem-service" class="mchem-form__label"><?php esc_html_e( 'Interested in', 'mchemconsultants' ); ?></label>
                    <div class="mchem-form__select-wrap">
                        <select id="mchem-service" name="service" class="mchem-form__select">
                            <option value="" disabled selected><?php esc_html_e( 'Select an engineering service', 'mchemconsultants' ); ?></option>
                            <option value="Process Simulation & Modeling">Process Simulation & Modeling</option>
                            <option value="Sustainable Engineering & Waste-to-Energy">Sustainable Engineering & Waste-to-Energy</option>
                            <option value="Process Safety & HAZOP Risk Studies">Process Safety & HAZOP Risk Studies (LOPA / QRA)</option>
                            <option value="Plant Design & Engineering Layouts">Plant Design & Engineering Layouts (PFD / P&ID)</option>
                            <option value="Energy Recovery & Pinch Integration">Energy Recovery & Pinch Integration</option>
                            <option value="Professional & Corporate Training">Professional & Corporate Training (CPD Masterclasses)</option>
                            <option value="Custom Engineering Consultation">Custom Chemical Engineering Consultation</option>
                        </select>
                        <svg class="mchem-form__select-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M6 9l6 6 6-6"/></svg>
                    </div>
                </div>

                <!-- Row 4: Preferred Date + Preferred Time Window -->
                <div class="mchem-form__row mchem-form__row--2col">
                    <div class="mchem-form__group">
                        <div class="mchem-form__label-row">
                            <label for="mchem-date" class="mchem-form__label"><?php esc_html_e( 'Preferred date', 'mchemconsultants' ); ?></label>
                            <span class="mchem-form__opt"><?php esc_html_e( 'Optional', 'mchemconsultants' ); ?></span>
                        </div>
                        <div class="mchem-form__date-wrap">
                            <input
                                type="date"
                                id="mchem-date"
                                name="pref_date"
                                class="mchem-form__input mchem-form__input--date"
                            >
                        </div>
                    </div>

                    <div class="mchem-form__group">
                        <div class="mchem-form__label-row">
                            <label for="mchem-time" class="mchem-form__label"><?php esc_html_e( 'Preferred time', 'mchemconsultants' ); ?></label>
                            <span class="mchem-form__opt"><?php esc_html_e( 'Optional', 'mchemconsultants' ); ?></span>
                        </div>
                        <div class="mchem-form__select-wrap">
                            <select id="mchem-time" name="pref_time" class="mchem-form__select">
                                <option value="" disabled selected><?php esc_html_e( 'Select a time window', 'mchemconsultants' ); ?></option>
                                <option value="Morning (09:00 - 12:00 PKT)">Morning (09:00 - 12:00 PKT)</option>
                                <option value="Afternoon (12:00 - 15:00 PKT)">Afternoon (12:00 - 15:00 PKT)</option>
                                <option value="Evening (15:00 - 18:00 PKT)">Evening (15:00 - 18:00 PKT)</option>
                                <option value="Flexible / As soon as possible">Flexible / As soon as possible</option>
                            </select>
                            <svg class="mchem-form__select-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M6 9l6 6 6-6"/></svg>
                        </div>
                    </div>
                </div>

                <!-- Row 5: Tell us about your project / Scope -->
                <div class="mchem-form__group">
                    <label for="mchem-message" class="mchem-form__label"><?php esc_html_e( 'Tell us about your project', 'mchemconsultants' ); ?></label>
                    <textarea
                        id="mchem-message"
                        name="message"
                        class="mchem-form__textarea"
                        rows="4"
                        placeholder="<?php esc_attr_e( 'Briefly describe what you would like to engineer, simulate, improve, or evaluate.', 'mchemconsultants' ); ?>"
                    ></textarea>
                </div>

                <!-- Row: File Upload -->
                <div class="mchem-form__group">
                    <div class="mchem-form__label-row">
                        <label for="mchem-file" class="mchem-form__label"><?php esc_html_e( 'Attach files', 'mchemconsultants' ); ?></label>
                        <span class="mchem-form__opt"><?php esc_html_e( 'Optional · Max 10MB', 'mchemconsultants' ); ?></span>
                    </div>
                    <div class="mchem-form__file-zone" id="mchem-file-zone">
                        <input type="file" id="mchem-file" name="project_file" class="mchem-form__file-input" accept=".pdf,.doc,.docx,.xls,.xlsx,.png,.jpg,.jpeg,.dwg" hidden>
                        <div class="mchem-form__file-prompt" id="mchem-file-prompt">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" x2="12" y1="3" y2="15"/></svg>
                            <span><?php esc_html_e( 'Drag & drop or', 'mchemconsultants' ); ?> <strong><?php esc_html_e( 'browse files', 'mchemconsultants' ); ?></strong></span>
                            <small><?php esc_html_e( 'PDF, DOC, XLS, PNG, JPG, DWG (up to 10MB)', 'mchemconsultants' ); ?></small>
                        </div>
                        <div class="mchem-form__file-selected" id="mchem-file-selected" hidden>
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                            <span class="mchem-form__file-name" id="mchem-file-name"></span>
                            <button type="button" class="mchem-form__file-remove" id="mchem-file-remove" aria-label="Remove file">&times;</button>
                        </div>
                    </div>
                </div>

                <!-- Row 6: Consent Checkbox -->
                <div class="mchem-form__consent">
                    <label class="mchem-form__checkbox-label">
                        <input type="checkbox" id="mchem-consent" name="consent" class="mchem-form__checkbox" checked required>
                        <span class="mchem-form__checkbox-custom"></span>
                        <span class="mchem-form__consent-text">
                            <?php esc_html_e( 'I agree that MChem Consultants may contact me regarding this engineering consultation request.', 'mchemconsultants' ); ?>
                        </span>
                    </label>
                </div>

                <!-- Row 7: Submit Button & Feedback Area (Matches Screenshot 3) -->
                <div class="mchem-form__submit-row">
                    <div class="mchem-form__feedback" id="mchem-form-feedback" role="alert" aria-live="polite"></div>

                    <button type="submit" class="mchem-btn mchem-btn--niw-primary mchem-form__btn" id="mchem-form-submit-btn">
                        <span class="mchem-form__btn-text"><?php esc_html_e( 'Request a consultation', 'mchemconsultants' ); ?></span>
                        <svg class="mchem-btn__arrow" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M7 17L17 7M17 7H7M17 7V17"/></svg>
                        <span class="mchem-form__spinner" aria-hidden="true"></span>
                    </button>
                </div>

            </form>
        </div>

    </div>
</section>

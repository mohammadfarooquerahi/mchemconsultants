/**
 * MChem Consultants - assets/js/whatsapp-form.js
 *
 * Handles AJAX submission of consultation form, country dropdown, and file upload.
 */

document.addEventListener('DOMContentLoaded', function() {
  const form = document.getElementById('mchem-booking-form');
  if (!form) return;

  const submitBtn = document.getElementById('mchem-form-submit-btn');
  const feedback = document.getElementById('mchem-form-feedback');

  // --- Country Dropdown Logic ---
  const countries = [
    {name: 'Pakistan', code: '+92', flag: '🇵🇰'},
    {name: 'United Arab Emirates', code: '+971', flag: '🇦🇪'},
    {name: 'Saudi Arabia', code: '+966', flag: '🇸🇦'},
    {name: 'United States', code: '+1', flag: '🇺🇸'},
    {name: 'United Kingdom', code: '+44', flag: '🇬🇧'},
    {name: 'Canada', code: '+1', flag: '🇨🇦'},
    {name: 'Australia', code: '+61', flag: '🇦🇺'},
    {name: 'Germany', code: '+49', flag: '🇩🇪'},
    {name: 'China', code: '+86', flag: '🇨🇳'},
    {name: 'India', code: '+91', flag: '🇮🇳'},
    {name: 'Qatar', code: '+974', flag: '🇶🇦'},
    {name: 'Oman', code: '+968', flag: '🇴🇲'},
    {name: 'Kuwait', code: '+965', flag: '🇰🇼'},
    {name: 'Bahrain', code: '+973', flag: '🇧🇭'},
    {name: 'Turkey', code: '+90', flag: '🇹🇷'},
    {name: 'Malaysia', code: '+60', flag: '🇲🇾'},
    {name: 'Singapore', code: '+65', flag: '🇸🇬'},
    {name: 'Indonesia', code: '+62', flag: '🇮🇩'},
    {name: 'Bangladesh', code: '+880', flag: '🇧🇩'},
    {name: 'Egypt', code: '+20', flag: '🇪🇬'},
    {name: 'South Africa', code: '+27', flag: '🇿🇦'},
    {name: 'Nigeria', code: '+234', flag: '🇳🇬'},
    {name: 'Kenya', code: '+254', flag: '🇰🇪'},
    {name: 'France', code: '+33', flag: '🇫🇷'},
    {name: 'Italy', code: '+39', flag: '🇮🇹'},
    {name: 'Netherlands', code: '+31', flag: '🇳🇱'},
    {name: 'Switzerland', code: '+41', flag: '🇨🇭'},
    {name: 'Sweden', code: '+46', flag: '🇸🇪'},
    {name: 'Norway', code: '+47', flag: '🇳🇴'},
    {name: 'Denmark', code: '+45', flag: '🇩🇰'},
    {name: 'Spain', code: '+34', flag: '🇪🇸'},
    {name: 'Japan', code: '+81', flag: '🇯🇵'},
    {name: 'South Korea', code: '+82', flag: '🇰🇷'},
    {name: 'Brazil', code: '+55', flag: '🇧🇷'},
    {name: 'Mexico', code: '+52', flag: '🇲🇽'},
    {name: 'New Zealand', code: '+64', flag: '🇳🇿'},
    {name: 'Other (International)', code: '+', flag: '🌐'}
  ];

  const countryBtn = document.getElementById('mchem-country-btn');
  const countryDropdown = document.getElementById('mchem-country-dropdown');
  const countrySearch = document.getElementById('mchem-country-search');
  const countryList = document.getElementById('mchem-country-list');
  const countryFlag = document.getElementById('mchem-country-flag');
  const countryCodeText = document.getElementById('mchem-country-code');
  const countryCodeInput = document.getElementById('mchem-country-code-input');

  function renderCountries(filter = '') {
    countryList.innerHTML = '';
    const filtered = countries.filter(c => c.name.toLowerCase().includes(filter.toLowerCase()) || c.code.includes(filter));
    filtered.forEach(country => {
      const li = document.createElement('li');
      li.innerHTML = `<span>${country.flag}</span> <span>${country.name}</span> <span style="color:var(--mchem-text-muted);margin-left:auto">${country.code}</span>`;
      li.addEventListener('click', () => {
        countryFlag.textContent = country.flag;
        countryCodeText.textContent = country.code;
        countryCodeInput.value = country.code;
        closeDropdown();
      });
      countryList.appendChild(li);
    });
  }

  function closeDropdown() {
    countryDropdown.hidden = true;
    countryBtn.setAttribute('aria-expanded', 'false');
  }

  if (countryBtn) {
    countryBtn.addEventListener('click', (e) => {
      e.stopPropagation();
      const isHidden = countryDropdown.hidden;
      countryDropdown.hidden = !isHidden;
      countryBtn.setAttribute('aria-expanded', !isHidden);
      if (!isHidden) {
        countrySearch.value = '';
        renderCountries();
        countrySearch.focus();
      }
    });

    countrySearch.addEventListener('input', (e) => renderCountries(e.target.value));
    countryDropdown.addEventListener('click', (e) => e.stopPropagation());
    document.addEventListener('click', closeDropdown);
    renderCountries();
  }

  // --- File Upload Logic ---
  const fileZone = document.getElementById('mchem-file-zone');
  const fileInput = document.getElementById('mchem-file');
  const filePrompt = document.getElementById('mchem-file-prompt');
  const fileSelected = document.getElementById('mchem-file-selected');
  const fileNameDisplay = document.getElementById('mchem-file-name');
  const fileRemoveBtn = document.getElementById('mchem-file-remove');

  if (fileZone) {
    fileZone.addEventListener('click', () => fileInput.click());

    fileZone.addEventListener('dragover', (e) => {
      e.preventDefault();
      fileZone.classList.add('is-dragover');
    });

    fileZone.addEventListener('dragleave', (e) => {
      e.preventDefault();
      fileZone.classList.remove('is-dragover');
    });

    fileZone.addEventListener('drop', (e) => {
      e.preventDefault();
      fileZone.classList.remove('is-dragover');
      if (e.dataTransfer.files.length) {
        fileInput.files = e.dataTransfer.files;
        handleFileSelect();
      }
    });

    fileInput.addEventListener('change', handleFileSelect);

    fileRemoveBtn.addEventListener('click', (e) => {
      e.stopPropagation();
      fileInput.value = '';
      fileSelected.hidden = true;
      filePrompt.hidden = false;
    });

    function handleFileSelect() {
      if (fileInput.files.length > 0) {
        const file = fileInput.files[0];
        if (file.size > 10 * 1024 * 1024) { // 10MB
          showError('File is too large. Max size is 10MB.');
          fileInput.value = '';
          return;
        }
        fileNameDisplay.textContent = file.name;
        filePrompt.hidden = true;
        fileSelected.hidden = false;
      }
    }
  }

  // --- Form Submit Logic ---
  form.addEventListener('submit', function(e) {
    e.preventDefault();

    feedback.className = 'mchem-form__feedback';
    feedback.textContent = '';

    const nameInput = document.getElementById('mchem-name');
    const emailInput = document.getElementById('mchem-email');
    const companyInput = document.getElementById('mchem-company');
    const phoneInput = document.getElementById('mchem-phone');
    const serviceInput = document.getElementById('mchem-service');
    const dateInput = document.getElementById('mchem-date');
    const timeInput = document.getElementById('mchem-time');
    const messageInput = document.getElementById('mchem-message');
    const consentInput = document.getElementById('mchem-consent');
    const nonceInput = document.getElementById('mchem_nonce_field');

    if (!nameInput.value.trim()) {
      showError('Please enter your full name.');
      nameInput.focus();
      return;
    }

    if (!emailInput.value.trim() || !validateEmail(emailInput.value.trim())) {
      showError('Please enter a valid work email address.');
      emailInput.focus();
      return;
    }

    if (consentInput && !consentInput.checked) {
      showError('Please agree to allow MChem Consultants to contact you.');
      return;
    }

    if (submitBtn) submitBtn.classList.add('is-loading');

    const rawPhone = phoneInput ? phoneInput.value.trim() : '';
    const selectedCode = countryCodeInput ? countryCodeInput.value.trim() : '+92';
    let finalPhone = '';
    if (rawPhone) {
      if (rawPhone.startsWith('+')) {
        finalPhone = rawPhone;
      } else if (selectedCode && selectedCode !== '+') {
        finalPhone = `${selectedCode} ${rawPhone}`;
      } else {
        finalPhone = rawPhone;
      }
    }

    const companyVal = companyInput ? companyInput.value.trim() : '';
    const serviceVal = serviceInput ? serviceInput.value : 'Process Simulation & Modeling';
    const dateVal = dateInput ? dateInput.value : '';
    const timeVal = timeInput ? timeInput.value : '';
    const messageVal = messageInput ? messageInput.value.trim() : '';

    // Build WhatsApp URL immediately from form data
    const waPhone = (typeof mchemData !== 'undefined' && mchemData.whatsapp_number) ? mchemData.whatsapp_number : '923320386271';
    const cleanPhone = waPhone.replace(/[^0-9]/g, '');
    
    let waMsg = `Hello MChem Consultants! 👋\n\nI have just submitted a consultation request on mchemconsultants.com:\n\n`;
    waMsg += `👤 *Name:* ${nameInput.value.trim()}\n`;
    waMsg += `📧 *Email:* ${emailInput.value.trim()}\n`;
    if (companyVal) waMsg += `🏢 *Company:* ${companyVal}\n`;
    if (finalPhone) waMsg += `📞 *Phone:* ${finalPhone}\n`;
    waMsg += `⚙️ *Service:* ${serviceVal}\n`;
    if (dateVal) waMsg += `📅 *Preferred Schedule:* ${dateVal} (${timeVal || 'Flexible'})\n`;
    if (messageVal) waMsg += `\n📝 *Project Scope:*\n${messageVal}\n`;

    const instantWaUrl = `https://wa.me/${cleanPhone}?text=${encodeURIComponent(waMsg)}`;

    // Open WhatsApp immediately in new tab (bypasses browser popup blockers on click)
    const waWindow = window.open(instantWaUrl, '_blank');

    // Build FormData for backend Email dispatch & DB save
    const formData = new FormData();
    formData.append('action', 'mchem_booking_submit');
    formData.append('nonce', (typeof mchemData !== 'undefined' && mchemData.nonce) ? mchemData.nonce : (nonceInput ? nonceInput.value : ''));
    formData.append('name', nameInput.value.trim());
    formData.append('email', emailInput.value.trim());
    formData.append('company', companyVal);
    formData.append('country_code', selectedCode);
    formData.append('phone', rawPhone);
    formData.append('service', serviceVal);
    formData.append('pref_date', dateVal);
    formData.append('pref_time', timeVal);
    formData.append('message', messageVal);

    if (fileInput && fileInput.files.length > 0) {
      formData.append('project_file', fileInput.files[0]);
    }

    const ajaxUrl = (typeof mchemData !== 'undefined' && mchemData.ajax_url) ? mchemData.ajax_url : '/wp-admin/admin-ajax.php';

    // Dispatch email and save to database
    fetch(ajaxUrl, {
      method: 'POST',
      body: formData,
    })
    .then(response => response.json())
    .then(data => {
      if (submitBtn) submitBtn.classList.remove('is-loading');

      const serverWaUrl = (data.success && data.data && data.data.whatsapp_url) ? data.data.whatsapp_url : instantWaUrl;
      showSuccessWithWA('Consultation request submitted! Email dispatched to engineering team and WhatsApp chat opened.', serverWaUrl);

      // If popup was blocked by browser, redirect window or update button
      if (!waWindow || waWindow.closed || typeof waWindow.closed === 'undefined') {
        window.open(serverWaUrl, '_blank');
      }

      form.reset();
      if (fileInput) {
        fileInput.value = '';
        fileSelected.hidden = true;
        filePrompt.hidden = false;
      }
    })
    .catch(err => {
      if (submitBtn) submitBtn.classList.remove('is-loading');
      showSuccessWithWA('Connecting you to WhatsApp...', instantWaUrl);
      if (!waWindow || waWindow.closed || typeof waWindow.closed === 'undefined') {
        window.open(instantWaUrl, '_blank');
      }
    });

  });

  function showError(msg) {
    feedback.className = 'mchem-form__feedback is-error';
    feedback.innerHTML = `<span style="color:#EF4444;font-weight:600;">⚠️ ${msg}</span>`;
  }

  function showSuccessWithWA(msg, waUrl) {
    feedback.className = 'mchem-form__feedback is-success';
    let html = `<div style="display:flex;flex-direction:column;gap:0.75rem;padding:0.5rem 0;">
      <span style="color:#10B981;font-weight:700;">✅ ${msg}</span>`;
    if (waUrl) {
      html += `<a href="${waUrl}" target="_blank" rel="noopener noreferrer" style="display:inline-flex;align-items:center;gap:0.5rem;background:#25D366;color:#ffffff;padding:0.6rem 1.25rem;border-radius:9999px;font-weight:700;font-size:0.88rem;text-decoration:none;box-shadow:0 4px 14px rgba(37,211,102,0.4);width:fit-content;">
        <span>👉 Click to Open WhatsApp Chat</span>
      </a>`;
    }
    html += `</div>`;
    feedback.innerHTML = html;
  }

  function showSuccess(msg) {
    feedback.className = 'mchem-form__feedback is-success';
    feedback.innerHTML = `<span style="color:#10B981;font-weight:700;">✅ ${msg}</span>`;
  }

  function validateEmail(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
  }
});

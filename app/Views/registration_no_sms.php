<?php $this->extend('guest_layout')?>

<?php $this->section('pageStyles')?>
<style>
.login-card {
  max-width: 450px;
  width: 100%;
  background-color: #ffffff;
  border: none;
  border-radius: 1rem;
  box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.1);
}

.btn-primary {
  background-color: #28a745;
  border-color: #28a745;
  transition: transform 0.2s ease-in-out;
}

.btn-primary:hover {
  background-color: #218838;
  border-color: #1e7e34;
  transform: translateY(-2px);
}

.text-green {
  color: #28a745;
}

/* Wizard progress bar */
.wizard-progress {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 2rem;
  position: relative;
}

.wizard-progress-bar {
  position: absolute;
  height: 4px;
  background-color: #e2e2e2;
  width: 100%;
  top: 50%;
  transform: translateY(-50%);
  z-index: 1;
}

.wizard-progress-step {
  display: flex;
  flex-direction: column;
  align-items: center;
  z-index: 2;
}

.wizard-progress-dot {
  width: 24px;
  height: 24px;
  background-color: #e2e2e2;
  border-radius: 50%;
  display: flex;
  justify-content: center;
  align-items: center;
  font-size: 0.8rem;
  color: white;
  transition: background-color 0.3s ease;
}

.wizard-progress-step.active .wizard-progress-dot {
  background-color: #28a745;
}

.wizard-progress-step.completed .wizard-progress-dot {
  background-color: #1e7e34;
}

.wizard-progress-text {
  font-size: 0.8rem;
  color: #6c757d;
  margin-top: 0.5rem;
  text-align: center;
}

.wizard-progress-step.active .wizard-progress-text,
.wizard-progress-step.completed .wizard-progress-text {
  color: #212529;
  font-weight: 500;
}

/* OTP input boxes */
.otp-input-group {
  display: flex;
  justify-content: space-between;
}

.otp-input {
  width: 50px;
  height: 50px;
  text-align: center;
  font-size: 1.5rem;
  border: 2px solid #ced4da;
  border-radius: 0.5rem;
  transition: all 0.2s ease-in-out;
}

.otp-input:focus {
  border-color: #28a745;
  box-shadow: 0 0 0 0.25rem rgba(40, 167, 69, 0.25);
}

.success-page {
  text-align: center;
  padding: 2rem;
}
</style>
<?php $this->endSection()?>

<?php $this->section('main')?>
<!-- Hero Section with OTP Card -->
<div class="d-flex align-items-center justify-content-center" style="background-color: #e9f5ee; padding: 4rem 0;">
  <div class="container py-5">
    <div class="row align-items-center">
      <div class="col-lg-6 mb-5 mb-lg-0 text-center text-lg-start">
        <h1 class="display-4 fw-bold mb-3">Getting Registration Number & Password</h1>
        <p class="lead text-muted mb-4">
          Seamlessly log in with your Registration No. and Password to access your dashboard and resources.
        </p>
      </div>
      <div class="col-lg-6 d-flex justify-content-center">
        <div class="login-card p-5">
          <div class="text-center mb-5">
            <h2 class="display-6 fw-bold text-dark mb-1">Get Access to Dashboard</h2>
            <p class="text-muted">Enter your details to get access to portal.</p>
          </div>

          <!-- Wizard Progress Bar -->
          <div class="wizard-progress">
            <div class="wizard-progress-bar"></div>
            <div id="step1" class="wizard-progress-step active">
              <div class="wizard-progress-dot">1</div>
              <div class="wizard-progress-text">User Details</div>
            </div>
            <div id="step2" class="wizard-progress-step">
              <div class="wizard-progress-dot">2</div>
              <div class="wizard-progress-text">OTP Verification</div>
            </div>
            <div id="step3" class="wizard-progress-step">
              <div class="wizard-progress-dot">3</div>
              <div class="wizard-progress-text">Success</div>
            </div>
          </div>

          <form id="verificationForm">
            <!-- Step 1: User Details -->
            <div id="step1Form">
              <input type="hidden" id="csrf_token" name="<?=csrf_token()?>" value="<?=csrf_hash()?>">
              <div class="mb-3">
                <label for="penNoInput" class="form-label fw-semibold text-dark">Pen No</label>
                <input type="text" class="form-control rounded-pill py-2" id="penNoInput" placeholder="A-0000-0-00-0000"
                  required>
              </div>
              <div class="mb-3">
                <label for="mobileNoInput" class="form-label fw-semibold text-dark">Mobile No</label>
                <input type="text" class="form-control rounded-pill py-2" id="mobileNoInput" placeholder="01700000000"
                  required>
              </div>
              <div class="mb-3">
                <label for="emailInput" class="form-label fw-semibold text-dark">Email Address</label>
                <input type="text" class="form-control rounded-pill py-2" id="emailInput"
                  placeholder="example@example.com" required>
              </div>
              <div class="mb-3">
                <label class="form-label fw-semibold text-dark mb-2">Preferred Delivery Method</label>
                <div class="d-flex gap-4">
                  <!-- <div class="form-check">
                    <input class="form-check-input" type="radio" name="deliveryMethod" id="deliveryEmail"
                      value="email" />
                    <label class="form-check-label text-muted" for="deliveryEmail">
                      Email
                    </label>
                  </div> -->
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="deliveryMethod" id="deliverySms" value="sms"
                      checked />
                    <label class="form-check-label text-muted" for="deliverySms">
                      SMS (Only 2 Times)
                    </label>
                  </div>
                  <!-- <div class="form-check">
                    <input class="form-check-input" type="radio" name="deliveryMethod" id="deliveryBoth" value="both">
                    <label class="form-check-label text-muted" for="deliveryBoth">
                      Both
                    </label>
                  </div> -->
                </div>
              </div>
              <div class="d-grid mb-4">
                <button type="button" class="btn btn-primary btn-lg rounded-pill fw-bold shadow-sm" id="nextButton">
                  Next
                  <span class="spinner-border spinner-border-sm ms-2" role="status" aria-hidden="true"
                    style="display: none;"></span>
                </button>
              </div>
            </div>

            <!-- Step 2: OTP Verification -->
            <div id="step2Form" style="display: none;">
              <div class="mb-3">
                <label class="form-label text-muted">Enter 4-digit OTP</label>
                <div class="otp-input-group">
                  <input type="text" class="form-control otp-input" maxlength="1" id="otp1">
                  <input type="text" class="form-control otp-input" maxlength="1" id="otp2">
                  <input type="text" class="form-control otp-input" maxlength="1" id="otp3">
                  <input type="text" class="form-control otp-input" maxlength="1" id="otp4">
                </div>
              </div>
              <div class="d-grid gap-2">
                <button type="button" class="btn btn-primary btn-lg rounded-pill fw-bold shadow-sm" id="verifyButton">
                  Verify and Login
                  <span class="spinner-border spinner-border-sm ms-2" role="status" aria-hidden="true"
                    style="display: none;"></span>
                </button>
                <button type="button" class="btn btn-link text-success fw-semibold" id="backButton">
                  Go Back
                </button>
              </div>
            </div>

            <!-- Step 3: Success -->
            <div id="step3Form" style="display: none;">
              <div class="success-page">
                <i class="fas fa-check-circle text-green mb-4" style="font-size: 4rem;"></i>
                <h3 class="fw-bold mb-2">Email/SMS Send Successful!</h3>
                <p class="text-muted">You have been successfully verified. To access dashboard <a
                    href="<?=base_url('login')?>">Login</a></p>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php $this->endSection()?>

<?php $this->section('pageScripts')?>
<script>
const step1Form = document.getElementById('step1Form');
const step2Form = document.getElementById('step2Form');
const step3Form = document.getElementById('step3Form');
const nextButton = document.getElementById('nextButton');
const verifyButton = document.getElementById('verifyButton');
const backButton = document.getElementById('backButton');
const step1 = document.getElementById('step1');
const step2 = document.getElementById('step2');
const step3 = document.getElementById('step3');

// Function to show/hide loading spinner
function showLoading(button, isLoading) {
  const spinner = button.querySelector('.spinner-border');
  if (isLoading) {
    spinner.style.display = 'inline-block';
    button.setAttribute('disabled', 'true');
  } else {
    spinner.style.display = 'none';
    button.removeAttribute('disabled');
  }
}

// Function to display an alert message
function showAlert(container, message, type) {
  const existingAlert = container.querySelector('.alert');
  if (existingAlert) {
    existingAlert.remove();
  }
  const alertDiv = document.createElement('div');
  alertDiv.className = `alert alert-${type} text-center mt-3`;
  alertDiv.innerHTML = message;
  container.prepend(alertDiv);
}

// Mock server-side function to simulate OTP sending
async function sendOtpToServer(penNo, mobileNo, emailAddress, chooseOption) {

  // get CSRF token from hidden field
  const csrfName = document.querySelector('#csrf_token').getAttribute('name');
  const csrfValue = document.querySelector('#csrf_token').value;

  try {
    const response = await fetch('<?=base_url('fcps-part-one/fetch-otp-candidate')?>', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
        'X-Requested-With': 'XMLHttpRequest'
      },
      body: new URLSearchParams({
        penNo,
        mobileNo,
        emailAddress,
        chooseOption,
        [csrfName]: csrfValue
      })
    });

    const data = await response.json();

    //Update the CSRF token if CodeIgniter rotates it
    if (data.csrf_token) {
      document.querySelector('#csrf_token').value = data.csrf_token;
    }

    return data;

  } catch (error) {
    console.error('Error:', error);
    return {
      success: false,
      message: 'Server error occurred.'
    };
  }
}

// Mock server-side function to simulate OTP verification
async function verifyOtpToServer(penNo, mobileNo, emailAddress, chooseOption, otp) {

  // get CSRF token from hidden field
  const csrfName = document.querySelector('#csrf_token').getAttribute('name');
  const csrfValue = document.querySelector('#csrf_token').value;

  try {
    const response = await fetch('<?=base_url('fcps-part-one/verify-otp')?>', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
        'X-Requested-With': 'XMLHttpRequest'
      },
      body: new URLSearchParams({
        penNo,
        mobileNo,
        emailAddress,
        chooseOption,
        [csrfName]: csrfValue,
        otp
      })
    });

    const data = await response.json();

    //Update the CSRF token if CodeIgniter rotates it
    if (data.csrf_token) {
      document.querySelector('#csrf_token').value = data.csrf_token;
    }

    return data;

  } catch (error) {
    console.error('Error:', error);
    return {
      success: false,
      message: 'Server error occurred.'
    };
  }
}

// Event listener for the "Next" button with Ajax
nextButton.addEventListener('click', async function() {
  const penNo = document.getElementById('penNoInput').value;
  const mobileNo = document.getElementById('mobileNoInput').value;
  const emailAddress = document.getElementById('emailInput').value;
  const chooseOption = document.querySelector('input[name="deliveryMethod"]:checked')?.value;

  showLoading(nextButton, true);

  const response = await sendOtpToServer(penNo, mobileNo, emailAddress, chooseOption);

  showLoading(nextButton, false);

  if (response.success) {
    step1Form.style.display = 'none';
    step2Form.style.display = 'block';

    step1.classList.remove('active');
    step1.classList.add('completed');
    step2.classList.add('active');

    showAlert(step2Form, response.message, 'success');
  } else {
    showAlert(step1Form, response.message, 'danger');
  }
});

// Event listener for the "Verify" button with Ajax
verifyButton.addEventListener('click', async function() {
  const otp = document.getElementById('otp1').value + document.getElementById('otp2').value + document
    .getElementById('otp3').value + document.getElementById('otp4').value;

  const penNo = document.getElementById('penNoInput').value;
  const mobileNo = document.getElementById('mobileNoInput').value;
  const emailAddress = document.getElementById('emailInput').value;
  const chooseOption = document.querySelector('input[name="deliveryMethod"]:checked')?.value;

  showLoading(verifyButton, true);

  const response = await verifyOtpToServer(penNo, mobileNo, emailAddress, chooseOption, otp);

  showLoading(verifyButton, false);

  if (response.success) {
    step2Form.style.display = 'none';
    step3Form.style.display = 'block';

    step2.classList.remove('active');
    step2.classList.add('completed');
    step3.classList.add('active');
  } else {
    showAlert(step2Form, response.message, 'danger');
  }
});

// Event listener for the "Go Back" button
backButton.addEventListener('click', function() {
  step1Form.style.display = 'block';
  step2Form.style.display = 'none';
  step1.classList.remove('completed');
  step1.classList.add('active');
  step2.classList.remove('active');

  // Clear any alert message
  const form = document.getElementById('verificationForm');
  const existingAlert = form.querySelector('.alert');
  if (existingAlert) {
    existingAlert.remove();
  }
});

// Auto-focus and move to the next OTP input box
const otpInputs = document.querySelectorAll('.otp-input');
otpInputs.forEach((input, index) => {
  input.addEventListener('input', () => {
    if (input.value.length === 1 && index < otpInputs.length - 1) {
      otpInputs[index + 1].focus();
    }
  });

  input.addEventListener('keydown', (event) => {
    if (event.key === 'Backspace' && input.value.length === 0 && index > 0) {
      otpInputs[index - 1].focus();
    }
  });
});
</script>
<?php $this->endSection()?>
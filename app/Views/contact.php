<?php $this->extend('guest_layout')?>
<?php $this->section('pageStyles')?>
<style>
.shadow-custom {
  box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
}

.btn-primary {
  /* A vibrant green to match the theme */
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
  /* Custom class for green accents */
  color: #28a745;
}

.footer-light {
  background-color: #5cb85c;
}

.contact-card-inner {
  background-color: #ffffff;
  border-left: 5px solid #28a745;
  padding: 1.5rem;
  border-radius: 0.5rem;
  box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
}

.card-title {
  font-size: 1.1rem;
  font-weight: 600;
  color: #16a34a;
  margin-bottom: 0.5rem;
}

.map-responsive {
  overflow: hidden;
  padding-bottom: 56.25%;
  /* 16:9 Aspect Ratio */
  position: relative;
  height: 0;
}

.map-responsive iframe {
  left: 0;
  top: 0;
  height: 100%;
  width: 100%;
  position: absolute;
  border: 0;
  border-radius: 0.5rem;
}
</style>
<?php $this->endSection()?>
<?php $this->section('main')?>
<div class="container py-5">
  <div class="text-center mb-5">
    <h1 class="display-6 fw-bold text-dark mb-4">Contact Us</h1>
    <p class="lead text-muted">Have a question or need support? Fill out the form below and we'll get back to you as
      soon as possible.</p>
  </div>
  <div class="row justify-content-center">
    <div class="col-lg-12">
      <div class="row g-5">
        <!-- Contact Form Card -->
        <div class="col-lg-6">
          <div class="card p-4 rounded-4 shadow-sm h-100">
            <div class="card-body">
              <h4 class="card-title text-center mb-4">Send us a message</h4>
              <form action="#" method="POST">
                <div class="mb-3">
                  <label for="name" class="form-label">Your Name</label>
                  <input type="text" class="form-control rounded-pill" id="name" name="name"
                    placeholder="Enter your full name" required>
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label">Email address</label>
                  <input type="email" class="form-control rounded-pill" id="email" name="email"
                    placeholder="name@example.com" required>
                </div>
                <div class="mb-3">
                  <label for="subject" class="form-label">Subject</label>
                  <input type="text" class="form-control rounded-pill" id="subject" name="subject"
                    placeholder="What is this about?" required>
                </div>
                <div class="mb-3">
                  <label for="message" class="form-label">Message</label>
                  <textarea class="form-control rounded-4" id="message" name="message" rows="5"
                    placeholder="Your message here..." required></textarea>
                </div>
                <div class="d-grid mt-4">
                  <button type="submit" class="btn btn-primary btn-lg rounded-pill fw-bold shadow-sm">Send
                    Message</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- Contact Details Card -->
        <div class="col-lg-6">
          <div class="card p-4 rounded-4 shadow-sm h-100">
            <div class="card-body">
              <h4 class="card-title mb-4">Contact Information</h4>
              <div class="d-flex flex-column gap-3">
                <div class="contact-card-inner">
                  <h5 class="card-title">Address</h5>
                  <address class="mb-0">
                    Bangladesh College of Physicians and Surgeons <br>
                    67, Shaheed Tajuddin Ahmed Sarani <br>
                    Mohakhali, Dhaka-1212. <br>
                    Bangladesh.
                  </address>
                </div>
                <div class="contact-card-inner">
                  <h5 class="card-title">Telephone, Fax, Web & Email</h5>
                  <div class="d-flex flex-column gap-2 mt-3">
                    <p class="mb-0"><strong>Telephone No:</strong> 02-222284189, 02-222291865, 02-222292501,
                      02-222284194<br>(PABX) EXT- 0/100</p>
                    <p class="mb-0"><strong>Fax:</strong> 02-222288928</p>
                    <p class="mb-0"><strong>Web:</strong> <a href="http://www.bcps.edu.bd"
                        class="text-green text-decoration-none" target="_blank">www.bcps.edu.bd</a></p>
                    <p class="mb-0"><strong>Email:</strong> <a href="mailto:rtmd@bcps.edu.bd"
                        class="text-green text-decoration-none">rtmd@bcps.edu.bd</a></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Google Map Section -->
  <div class="row justify-content-center mt-5">
    <div class="col-lg-12">
      <div class="card p-4 rounded-4 shadow-sm">
        <h4 class="card-title mb-4">Our Location</h4>
        <div class="map-responsive">
          <!-- The embedded Google Map already includes a location pin by default. -->
          <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3651.1613348267056!2d90.3965862145623!3d23.777268584576113!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c76f293b6a5f%3A0xc58a70832f7d8247!2sBangladesh+College+of+Physicians+and+Surgeons+(BCPS)!5e0!3m2!1sen!2sbd!4v1525509116614"
            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
      </div>
    </div>
  </div>
</div>
<?php $this->endSection()?>
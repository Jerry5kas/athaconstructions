@props(['seo' => []])

<section 
    class="hero-shell"
    x-data="{
        formSubmitting: false,
        formMessage: '',
        panelActive: false,
        focusDepth: 0,
        listboxOpen: false,
        submit(event) {
            this.formSubmitting = true;
            fetch('{{ route('contact.submit') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(Object.fromEntries(new FormData(event.target)))
            })
            .then(res => res.json())
            .then(data => {
                this.formMessage = data.status === 'OK' ? 'success' : 'error';
                if (data.status === 'OK') {
                    event.target.reset();
                }
                setTimeout(() => this.formMessage = '', 5000);
            })
            .catch(() => this.formMessage = 'error')
            .finally(() => this.formSubmitting = false);
        },
        openPanel() {
            if (!this.panelActive) this.panelActive = true;
        },
        closePanel() {
            if (this.focusDepth === 0 && !this.listboxOpen) this.panelActive = false;
        }
    }"
    :class="{ 'hero-shell--active': panelActive }"
    @mouseenter.self="openPanel"
    @mouseleave.self="closePanel"
    @focusin="focusDepth++; panelActive = true"
    @focusout="
        focusDepth = Math.max(focusDepth - 1, 0);
        setTimeout(() => {
            if (focusDepth === 0 && !listboxOpen && !$el.matches(':hover')) {
                panelActive = false;
            }
        }, 0);
    "
>
    <h1 class="sr-only">{{ $seo['h1'] ?? '' }}</h1>

    <x-header overlay="true" />

    <div class="hero-video-layer" @mouseenter="openPanel" @mouseleave="closePanel">
        <video autoplay muted loop playsinline class="hero-video">
            <source src="{{ asset('images/banner.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>

    <div class="hero-overlay"></div>

    <div class="hero-form-panel">
        <div class="hero-form-card" @mouseenter="openPanel" @mouseleave="closePanel">
            <h2 class="hero-form-title">Quick Enquiry</h2>
            <p class="hero-form-subtitle">Let's build your dream together</p>

            <div 
                x-show="formMessage" 
                x-transition 
                class="hero-form-message" 
                :class="formMessage === 'success' ? 'hero-form-message--success' : 'hero-form-message--error'"
            >
                <span x-text="formMessage === 'success' ? 'Thank you! We will contact you soon.' : 'Something went wrong. Please try again.'"></span>
            </div>

            <form @submit.prevent="submit($event)">
                <div class="hero-form-grid">
                    <input type="text" name="name" placeholder="Your Name" required class="hero-input">
                    <input type="tel" name="phone" placeholder="Phone Number" required class="hero-input">
                    <input type="email" name="email" placeholder="Email Address" class="hero-input">
                    <div class="hero-select">
                        <select 
                            name="type" 
                            required 
                            class="hero-input hero-input--select"
                            @change="$event.target.blur()"
                            @focus="focusDepth++; listboxOpen = true; openPanel()"
                            @blur="focusDepth = Math.max(focusDepth - 1, 0); listboxOpen = false; closePanel()"
                        >
                            <option value="">Construction Type</option>
                            <option value="residential">Residential</option>
                            <option value="commercial">Commercial</option>
                        </select>
                        <span class="hero-select__chevron" aria-hidden="true">
                            <svg viewBox="0 0 24 24" class="hero-select__icon">
                                <path d="M6 10l6 6 6-6" />
                            </svg>
                        </span>
                    </div>
                    <input type="text" name="plotsize" placeholder="Plot Size (Sq.Ft)" class="hero-input">
                    <input type="hidden" name="message" value="Quick enquiry from hero form">
                    <button type="submit" class="hero-submit" :disabled="formSubmitting">
                        <span x-show="!formSubmitting">Submit Enquiry</span>
                        <span x-show="formSubmitting">Submitting...</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

@once
    <style>
        .hero-shell {
            position: relative;
            min-height: 100vh;
            width: 100%;
            overflow: hidden;
            background: #000;
            padding-top: 82px;
        }

        .hero-video-layer {
            position: absolute;
            inset: 0;
            overflow: hidden;
        }

        .hero-video {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .hero-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.45);
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.4s ease;
            z-index: 40;
        }

        .hero-shell--active .hero-overlay {
            opacity: 1;
        }

        .hero-form-panel {
            position: absolute;
            top: 0;
            right: 0;
            height: 100%;
            width: min(30vw, 420px);
            min-width: 320px;
            display: flex;
            align-items: stretch;
            justify-content: flex-end;
            padding: 0;
            transform: translateX(100%);
            transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 110;
            box-sizing: border-box;
        }

        .hero-shell--active .hero-form-panel {
            transform: translateX(0);
        }

        .hero-form-card {
            position: relative;
            margin-top: 82px;
            background: rgba(0, 0, 0, 0.88);
            padding: 48px 36px;
            border-radius: 220px 0 0 220px;
            color: #fff;
            width: 100%;
            height: calc(100% - 82px);
            box-shadow: 0 45px 80px rgba(0, 0, 0, 0.55);
            border: 1px solid rgba(255, 255, 255, 0.08);
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .hero-form-title {
            font-size: 28px;
            font-weight: 600;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            margin-bottom: 10px;
        }

        .hero-form-subtitle {
            font-size: 14px;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            margin-bottom: 24px;
            opacity: 0.8;
        }

        .hero-form-message {
            margin-bottom: 20px;
            padding: 12px 16px;
            border-radius: 12px;
            font-size: 13px;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            text-align: center;
        }

        .hero-form-message--success {
            background: rgba(34, 197, 94, 0.12);
            color: #4ade80;
        }

        .hero-form-message--error {
            background: rgba(248, 113, 113, 0.12);
            color: #f87171;
        }

        .hero-form-grid {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .hero-select {
            position: relative;
        }

        .hero-input {
            width: 100%;
            padding: 12px 4px;
            font-size: 13px;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            background: transparent;
            border: none;
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
            color: #fff;
            outline: none;
        }

        .hero-input::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        .hero-input:focus {
            border-bottom-color: #fff;
        }

        .hero-input--select {
            appearance: none;
            -webkit-appearance: none;
            padding-right: 28px;
            cursor: pointer;
            background-color: transparent;
        }

        .hero-input--select option {
            background: #050505;
            color: #fff;
        }

        .hero-select__chevron {
            position: absolute;
            top: 50%;
            right: 0;
            width: 22px;
            height: 22px;
            pointer-events: none;
            transform: translateY(-50%);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hero-select__icon {
            width: 14px;
            height: 14px;
            stroke: #fff;
            stroke-width: 1.5;
            fill: none;
            opacity: 0.7;
            transition: transform 0.25s ease, opacity 0.25s ease;
        }

        .hero-input--select:hover + .hero-select__chevron .hero-select__icon,
        .hero-input--select:focus + .hero-select__chevron .hero-select__icon {
            opacity: 1;
        }

        .hero-input--select:focus + .hero-select__chevron .hero-select__icon {
            transform: rotate(180deg);
        }

        .hero-submit {
            margin-top: 10px;
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 999px;
            background: #fff;
            color: #000;
            font-size: 13px;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            font-weight: 600;
            cursor: pointer;
        }

        @media (max-width: 1024px) {
            .hero-shell {
                min-height: auto;
            }

            .hero-form-panel {
                position: relative;
                right: auto;
                transform: none !important;
                width: 100%;
                min-width: 0;
                padding: 32px 20px;
            }

            .hero-form-card {
                margin-top: 0;
                height: auto;
                background: rgba(0, 0, 0, 0.9);
                border-radius: 32px;
            }
        }

        @media (max-width: 640px) {
            .hero-form-card {
                border-radius: 24px;
                padding: 24px;
            }

            .hero-form-title {
                font-size: 22px;
                letter-spacing: 0.15em;
            }

            .hero-form-subtitle {
                letter-spacing: 0.1em;
            }
        }
    </style>
@endonce


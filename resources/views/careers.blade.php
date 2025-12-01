<x-layouts 
    :title="$seo['title']" 
    :description="$seo['description']" 
    :keywords="$seo['keywords']"
>
    {{-- Page Banner --}}
    <x-page-banner
        pageTitle="Careers at Atha Construction"
        contentTitle="Atha Construction Career"
        description="Join a team that is reshaping how homes are built in Bangalore—with craftsmanship, integrity, and long-term commitment."
        backgroundImage="images/about/about-banner.png"
        alt="Atha Construction Careers"
        title="Atha Construction Careers"
    />

    {{-- Careers Section --}}
    <section class="py-12 lg:py-16" id="next-section" x-data="{ 
        openAccordion: 0,
        toggleAccordion(index) {
            this.openAccordion = this.openAccordion === index ? null : index;
        },
        fileName: '',
        formSubmitting: false,
        formMessage: '',
        formErrors: {},
        handleFileChange(event) {
            const file = event.target.files[0];
            if (file) {
                this.fileName = file.name;
            } else {
                this.fileName = '';
            }
        },
        submitForm(event) {
            this.formSubmitting = true;
            this.formMessage = '';
            this.formErrors = {};
            
            const formData = new FormData(event.target);
            
            fetch('{{ route('careers.submit') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.errors) {
                    this.formErrors = data.errors;
                    this.formMessage = 'error';
                } else if (data.status === 'OK' || data.message) {
                    this.formMessage = 'success';
                    event.target.reset();
                    this.fileName = '';
                    this.formErrors = {};
                    setTimeout(() => {
                        this.formMessage = '';
                    }, 5000);
                } else {
                    this.formMessage = 'error';
                }
            })
            .catch(() => {
                this.formMessage = 'error';
            })
            .finally(() => {
                this.formSubmitting = false;
            });
        }
    }">
        <div class="container mx-auto px-4">
            <div class="grid lg:grid-cols-2 gap-8 lg:gap-12">
                {{-- Job Positions Accordion --}}
                <div>
                    <div class="space-y-3">
                        @foreach($jobPositions as $index => $job)
                            <div class="rounded-lg overflow-hidden mb-3">
                                {{-- Accordion Header --}}
                                <button
                                    @click="toggleAccordion({{ $index }})"
                                    class="w-full px-8 py-3 flex items-center justify-between bg-black text-white transition-all duration-300 relative rounded-lg"
                                    :class="openAccordion === {{ $index }} ? '' : ''"
                                >
                                    <span class="font-tenor text-base lg:text-lg uppercase font-semibold">
                                        {{ $job['title'] }}
                                    </span>
                                    {{-- Icon on the left with white border --}}
                                    <div class="absolute left-0 top-0 bottom-0 flex items-center">
                                        <div 
                                            class="w-10 h-10 bg-black rounded-full border-[5px] border-white flex items-center justify-center ml-5 transition-transform duration-300 hover:rotate-180"
                                            :class="openAccordion === {{ $index }} ? '' : ''"
                                        >
                                            <template x-if="openAccordion === {{ $index }}">
                                                <i class="fas fa-minus text-white text-sm"></i>
                                            </template>
                                            <template x-if="openAccordion !== {{ $index }}">
                                                <i class="fas fa-plus text-white text-sm"></i>
                                            </template>
                                        </div>
                                    </div>
                                </button>

                                {{-- Accordion Body --}}
                                <div 
                                    x-show="openAccordion === {{ $index }}"
                                    x-collapse
                                    class="bg-gray-900 text-white"
                                >
                                    <div class="px-6 py-5">
                                        <p class="text-sm lg:text-base leading-relaxed mb-4 text-white">
                                            {{ $job['description'] }}
                                        </p>
                                        <ul class="text-sm lg:text-base text-white space-y-2">
                                            <li><strong>Qualification:</strong> {{ $job['qualification'] }}</li>
                                            <li><strong>Min. Experience:</strong> {{ $job['experience'] }}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Application Form --}}
                <div>
                    <div class="bg-gray-100 rounded-lg shadow-lg p-6 lg:p-8">
                        <h3 class="font-tenor text-xl lg:text-2xl uppercase mb-6">Apply Now</h3>

                        {{-- Success/Error Messages --}}
                        <div 
                            x-show="formMessage === 'success'"
                            x-cloak
                            x-transition
                            class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 text-sm rounded"
                        >
                            Thank you! We have received your application and will contact you soon.
                        </div>
                        <div 
                            x-show="formMessage === 'error'"
                            x-cloak
                            x-transition
                            class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 text-sm rounded"
                        >
                            Something went wrong. Please check your inputs and try again.
                        </div>

                        <form @submit.prevent="submitForm($event)" class="space-y-4" enctype="multipart/form-data">
                            {{-- Name and Email Row --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <input 
                                        type="text" 
                                        name="name" 
                                        placeholder="Name"
                                        required
                                        :class="formErrors.name ? 'border-red-500' : 'border-gray-300'"
                                        class="w-full px-4 py-3 bg-white border rounded-lg focus:outline-none focus:border-black transition-colors"
                                    >
                                    <p x-show="formErrors.name" x-cloak class="text-red-500 text-xs mt-1" x-text="formErrors.name?.[0]"></p>
                                </div>
                                <div>
                                    <input 
                                        type="email" 
                                        name="email" 
                                        placeholder="Email"
                                        required
                                        :class="formErrors.email ? 'border-red-500' : 'border-gray-300'"
                                        class="w-full px-4 py-3 bg-white border rounded-lg focus:outline-none focus:border-black transition-colors"
                                    >
                                    <p x-show="formErrors.email" x-cloak class="text-red-500 text-xs mt-1" x-text="formErrors.email?.[0]"></p>
                                </div>
                            </div>

                            {{-- Phone and City Row --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <input 
                                        type="tel" 
                                        name="phone" 
                                        placeholder="Phone No."
                                        required
                                        :class="formErrors.phone ? 'border-red-500' : 'border-gray-300'"
                                        class="w-full px-4 py-3 bg-white border rounded-lg focus:outline-none focus:border-black transition-colors"
                                    >
                                    <p x-show="formErrors.phone" x-cloak class="text-red-500 text-xs mt-1" x-text="formErrors.phone?.[0]"></p>
                                </div>
                                <div>
                                    <input 
                                        type="text" 
                                        name="city" 
                                        placeholder="City"
                                        :class="formErrors.city ? 'border-red-500' : 'border-gray-300'"
                                        class="w-full px-4 py-3 bg-white border rounded-lg focus:outline-none focus:border-black transition-colors"
                                    >
                                    <p x-show="formErrors.city" x-cloak class="text-red-500 text-xs mt-1" x-text="formErrors.city?.[0]"></p>
                                </div>
                            </div>

                            {{-- Position and Experience Row --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <select 
                                        name="post" 
                                        required
                                        :class="formErrors.post ? 'border-red-500' : 'border-gray-300'"
                                        class="w-full px-4 py-3 bg-white border rounded-lg focus:outline-none focus:border-black transition-colors"
                                    >
                                        <option value="">Select Apply For</option>
                                        @foreach($jobPositions as $job)
                                            <option value="{{ $job['title'] }}">{{ $job['title'] }}</option>
                                        @endforeach
                                    </select>
                                    <p x-show="formErrors.post" x-cloak class="text-red-500 text-xs mt-1" x-text="formErrors.post?.[0]"></p>
                                </div>
                                <div>
                                    <select 
                                        name="experience"
                                        required
                                        :class="formErrors.experience ? 'border-red-500' : 'border-gray-300'"
                                        class="w-full px-4 py-3 bg-white border rounded-lg focus:outline-none focus:border-black transition-colors"
                                    >
                                        <option value="">Select Experience</option>
                                        <option value="Less than 2 Years">Less than 2 Years</option>
                                        <option value="2-5 Years">2-5 Years</option>
                                        <option value="More than 5 Years">More than 5 Years</option>
                                    </select>
                                    <p x-show="formErrors.experience" x-cloak class="text-red-500 text-xs mt-1" x-text="formErrors.experience?.[0]"></p>
                                </div>
                            </div>

                            {{-- Message --}}
                            <div>
                                <textarea 
                                    name="msg" 
                                    rows="4"
                                    placeholder="Message"
                                    :class="formErrors.msg ? 'border-red-500' : 'border-gray-300'"
                                    class="w-full px-4 py-3 bg-white border rounded-lg focus:outline-none focus:border-black transition-colors resize-none"
                                ></textarea>
                                <p x-show="formErrors.msg" x-cloak class="text-red-500 text-xs mt-1" x-text="formErrors.msg?.[0]"></p>
                            </div>

                            {{-- File Upload --}}
                            <div>
                                <div class="relative">
                                    <div class="flex items-center border border-gray-300 rounded-lg bg-white overflow-hidden">
                                        <div class="flex-1 px-4 py-3">
                                            <span x-show="!fileName" class="text-gray-500 text-sm">Select your file!</span>
                                            <span x-show="fileName" class="text-black text-sm" x-text="fileName"></span>
                                        </div>
                                        <label for="fileUpload" class="px-6 py-3 bg-black text-white text-sm uppercase font-semibold cursor-pointer hover:bg-gray-800 transition-colors">
                                            Upload Resume
                                        </label>
                                        <input 
                                            type="file" 
                                            id="fileUpload"
                                            name="files" 
                                            accept=".pdf,.doc,.docx"
                                            @change="handleFileChange($event)"
                                            class="hidden"
                                        >
                                    </div>
                                </div>
                                <p class="text-xs text-gray-500 mt-1">Accepted formats: PDF, DOC, DOCX (Max 10MB)</p>
                                <p x-show="formErrors.files" x-cloak class="text-red-500 text-xs mt-1" x-text="formErrors.files?.[0]"></p>
                            </div>

                            {{-- Submit Button --}}
                            <div class="pt-4">
                                <button 
                                    type="submit" 
                                    :disabled="formSubmitting"
                                    class="w-full px-8 py-3 border-2 border-black text-black text-sm uppercase tracking-wide hover:bg-black hover:text-white transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed"
                                >
                                    <span x-show="!formSubmitting">Submit</span>
                                    <span x-show="formSubmitting">Submitting...</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts>

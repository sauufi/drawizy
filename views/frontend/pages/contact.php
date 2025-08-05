<!-- Hero Section -->
<div class="text-center mb-12 relative">
    <div class="absolute inset-0 bg-gradient-to-r from-green-100 via-yellow-100 to-pink-100 rounded-3xl opacity-60"></div>
    <div class="relative z-10 py-12">
        <!-- Floating decorations -->
        <div class="absolute top-4 left-8 text-4xl animate-pulse opacity-70">💌</div>
        <div class="absolute top-8 right-12 text-3xl animate-bounce opacity-70">📞</div>
        <div class="absolute bottom-4 left-12 text-3xl animate-pulse opacity-70" style="animation-delay: 0.5s;">✨</div>
        <div class="absolute bottom-8 right-8 text-4xl animate-bounce opacity-70" style="animation-delay: 0.3s;">🎈</div>

        <h1 class="text-5xl md:text-6xl font-kids text-transparent bg-clip-text bg-gradient-to-r from-green-500 via-yellow-500 to-pink-500 mb-6">
            📮 Get In Touch With Us! 💝
        </h1>
        <div class="w-40 h-3 bg-gradient-to-r from-green-400 via-yellow-400 to-pink-400 mx-auto rounded-full mb-6"></div>
        <p class="text-2xl text-gray-700 font-semibold max-w-4xl mx-auto leading-relaxed">
            We love hearing from our creative families! Have questions, suggestions, or just want to say hello?
            We're here to help make your coloring experience even more magical! 🌟✨
        </p>
    </div>
</div>

<!-- Contact Form and Info Grid -->
<div class="max-w-7xl mx-auto mb-16">
    <div class="grid lg:grid-cols-2 gap-12">
        <!-- Contact Form -->
        <div class="bg-gradient-to-br from-blue-50 to-purple-50 rounded-3xl p-8 shadow-xl border-4 border-white relative overflow-hidden">
            <!-- Background decorations -->
            <div class="absolute top-4 right-4 text-6xl opacity-10">📝</div>
            <div class="absolute bottom-4 left-4 text-5xl opacity-10">💕</div>

            <div class="relative z-10">
                <h2 class="text-3xl font-kids text-purple-700 mb-6 text-center">
                    ✉️ Send Us a Message!
                </h2>

                <form action="/contact" method="POST" class="space-y-6">
                    <!-- Name Field -->
                    <div>
                        <label for="name" class="block text-lg font-semibold text-purple-700 mb-2">
                            👤 Your Name *
                        </label>
                        <input type="text" id="name" name="name" required
                            class="w-full px-4 py-3 border-2 border-purple-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-purple-400 text-gray-700 font-semibold shadow-md transition-all duration-300"
                            placeholder="Tell us your name! 😊">
                    </div>

                    <!-- Email Field -->
                    <div>
                        <label for="email" class="block text-lg font-semibold text-purple-700 mb-2">
                            📧 Email Address *
                        </label>
                        <input type="email" id="email" name="email" required
                            class="w-full px-4 py-3 border-2 border-purple-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-purple-400 text-gray-700 font-semibold shadow-md transition-all duration-300"
                            placeholder="your@email.com">
                    </div>

                    <!-- Subject Field -->
                    <div>
                        <label for="subject" class="block text-lg font-semibold text-purple-700 mb-2">
                            📋 Subject
                        </label>
                        <select id="subject" name="subject"
                            class="w-full px-4 py-3 border-2 border-purple-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-purple-400 text-gray-700 font-semibold shadow-md transition-all duration-300">
                            <option value="">Choose a topic... 🎯</option>
                            <option value="general">💬 General Question</option>
                            <option value="feedback">⭐ Feedback & Suggestions</option>
                            <option value="technical">🔧 Technical Support</option>
                            <option value="copyright">©️ Copyright Question</option>
                            <option value="partnership">🤝 Partnership Inquiry</option>
                            <option value="compliment">💖 Compliment or Thank You</option>
                            <option value="other">🌈 Something Else</option>
                        </select>
                    </div>

                    <!-- Message Field -->
                    <div>
                        <label for="message" class="block text-lg font-semibold text-purple-700 mb-2">
                            💌 Your Message *
                        </label>
                        <textarea id="message" name="message" rows="6" required
                            class="w-full px-4 py-3 border-2 border-purple-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-purple-400 text-gray-700 font-semibold shadow-md transition-all duration-300 resize-none"
                            placeholder="Tell us what's on your mind! We love hearing from our creative families! 🎨✨"></textarea>
                    </div>

                    <!-- Age-appropriate checkbox -->
                    <div class="flex items-start space-x-3 bg-yellow-50 p-4 rounded-2xl border-2 border-yellow-200">
                        <input type="checkbox" id="parent_consent" name="parent_consent"
                            class="mt-1 h-4 w-4 text-purple-600 focus:ring-purple-500 border-2 border-gray-300 rounded">
                        <label for="parent_consent" class="text-sm text-gray-700 font-semibold leading-relaxed">
                            🛡️ If you're under 13, please make sure a parent or guardian helps you send this message.
                            We want to keep all our young artists safe! 👨‍👩‍👧‍👦
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <div class="text-center">
                        <button type="submit" class="bg-gradient-to-r from-green-400 via-yellow-500 to-pink-500 text-white font-bold py-4 px-8 rounded-full hover:from-green-500 hover:via-yellow-600 hover:to-pink-600 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1 text-lg">
                            🚀 Send Our Message! ✨
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Contact Information -->
        <div class="space-y-6">
            <!-- Quick Contact Card -->
            <div class="bg-white rounded-2xl p-6 shadow-lg border-4 border-green-200 hover:border-green-400 transition-all transform hover:scale-105">
                <div class="text-center">
                    <div class="text-5xl mb-4">⚡</div>
                    <h3 class="text-2xl font-kids text-green-700 mb-4">Quick Contact</h3>
                    <div class="space-y-3 text-gray-700 font-semibold">
                        <p class="flex items-center justify-center">
                            <span class="text-2xl mr-2">📧</span>
                            <a href="mailto:hello@<?= parse_url($_SERVER['HTTP_HOST'] ?? 'example.com', PHP_URL_HOST) ?>" class="text-green-600 hover:text-green-800 hover:underline">
                                hello@<?= parse_url($_SERVER['HTTP_HOST'] ?? 'example.com', PHP_URL_HOST) ?>
                            </a>
                        </p>
                        <p class="flex items-center justify-center">
                            <span class="text-2xl mr-2">🕐</span>
                            Response time: Within 24 hours!
                        </p>
                    </div>
                </div>
            </div>

            <!-- Different Ways to Reach Us -->
            <div class="bg-white rounded-2xl p-6 shadow-lg border-4 border-blue-200">
                <h3 class="text-2xl font-kids text-blue-700 mb-4 text-center">
                    📬 Different Ways to Reach Us!
                </h3>
                <div class="space-y-4">
                    <div class="flex items-center p-3 bg-blue-50 rounded-xl">
                        <span class="text-3xl mr-3">💬</span>
                        <div>
                            <h4 class="font-bold text-blue-700">General Questions</h4>
                            <p class="text-sm text-gray-600 font-semibold">info@<?= parse_url($_SERVER['HTTP_HOST'] ?? 'example.com', PHP_URL_HOST) ?></p>
                        </div>
                    </div>

                    <div class="flex items-center p-3 bg-purple-50 rounded-xl">
                        <span class="text-3xl mr-3">🔧</span>
                        <div>
                            <h4 class="font-bold text-purple-700">Technical Support</h4>
                            <p class="text-sm text-gray-600 font-semibold">support@<?= parse_url($_SERVER['HTTP_HOST'] ?? 'example.com', PHP_URL_HOST) ?></p>
                        </div>
                    </div>

                    <div class="flex items-center p-3 bg-red-50 rounded-xl">
                        <span class="text-3xl mr-3">©️</span>
                        <div>
                            <h4 class="font-bold text-red-700">Copyright Issues</h4>
                            <p class="text-sm text-gray-600 font-semibold">dmca@<?= parse_url($_SERVER['HTTP_HOST'] ?? 'example.com', PHP_URL_HOST) ?></p>
                        </div>
                    </div>

                    <div class="flex items-center p-3 bg-green-50 rounded-xl">
                        <span class="text-3xl mr-3">🤝</span>
                        <div>
                            <h4 class="font-bold text-green-700">Partnerships</h4>
                            <p class="text-sm text-gray-600 font-semibold">partners@<?= parse_url($_SERVER['HTTP_HOST'] ?? 'example.com', PHP_URL_HOST) ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Fun Facts -->
            <div class="bg-gradient-to-br from-yellow-50 to-orange-50 rounded-2xl p-6 shadow-lg border-4 border-yellow-200">
                <h3 class="text-2xl font-kids text-orange-700 mb-4 text-center">
                    🌟 Fun Contact Facts!
                </h3>
                <div class="space-y-3 text-gray-700 font-semibold">
                    <div class="flex items-center">
                        <span class="text-2xl mr-3">📨</span>
                        <span>We read every single message with a big smile!</span>
                    </div>
                    <div class="flex items-center">
                        <span class="text-2xl mr-3">⏰</span>
                        <span>Most replies sent within 24 hours (often much faster!)</span>
                    </div>
                    <div class="flex items-center">
                        <span class="text-2xl mr-3">🌍</span>
                        <span>We love hearing from families all around the world!</span>
                    </div>
                    <div class="flex items-center">
                        <span class="text-2xl mr-3">❤️</span>
                        <span>Your feedback helps us create better content!</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- FAQ Section -->
<div class="max-w-6xl mx-auto mb-16">
    <div class="text-center mb-8">
        <h2 class="text-4xl font-kids text-transparent bg-clip-text bg-gradient-to-r from-purple-500 to-blue-600 mb-4">
            ❓ Frequently Asked Questions
        </h2>
        <div class="w-32 h-2 bg-gradient-to-r from-purple-400 to-blue-500 mx-auto rounded-full"></div>
        <p class="text-xl text-gray-700 font-semibold mt-4">
            Quick answers to questions our creative families often ask! 🤔✨
        </p>
    </div>

    <div class="grid md:grid-cols-2 gap-6">
        <!-- FAQ Item 1 -->
        <div class="bg-white rounded-2xl p-6 shadow-lg border-4 border-purple-200 hover:border-purple-400 transition-all">
            <h4 class="text-xl font-kids text-purple-700 mb-3 flex items-center">
                <span class="text-2xl mr-2">🎨</span>
                How do I download coloring pages?
            </h4>
            <p class="text-gray-600 font-semibold">
                Simply click on any coloring page you like, then click the download button!
                It's completely free and you can print as many copies as you want for personal use.
            </p>
        </div>

        <!-- FAQ Item 2 -->
        <div class="bg-white rounded-2xl p-6 shadow-lg border-4 border-blue-200 hover:border-blue-400 transition-all">
            <h4 class="text-xl font-kids text-blue-700 mb-3 flex items-center">
                <span class="text-2xl mr-2">💰</span>
                Is everything really free?
            </h4>
            <p class="text-gray-600 font-semibold">
                Yes! All our coloring pages are 100% free for personal, educational, and non-commercial use.
                We believe creativity should be accessible to everyone!
            </p>
        </div>

        <!-- FAQ Item 3 -->
        <div class="bg-white rounded-2xl p-6 shadow-lg border-4 border-green-200 hover:border-green-400 transition-all">
            <h4 class="text-xl font-kids text-green-700 mb-3 flex items-center">
                <span class="text-2xl mr-2">🏫</span>
                Can teachers use these in classrooms?
            </h4>
            <p class="text-gray-600 font-semibold">
                Absolutely! Teachers and educators are welcome to use our coloring pages in their classrooms,
                lesson plans, and educational activities. Education is one of our favorite uses!
            </p>
        </div>

        <!-- FAQ Item 4 -->
        <div class="bg-white rounded-2xl p-6 shadow-lg border-4 border-pink-200 hover:border-pink-400 transition-all">
            <h4 class="text-xl font-kids text-pink-700 mb-3 flex items-center">
                <span class="text-2xl mr-2">📱</span>
                Do you have a mobile app?
            </h4>
            <p class="text-gray-600 font-semibold">
                Our website works great on phones and tablets! While we don't have a dedicated app yet,
                our mobile-friendly site gives you access to all our coloring pages anywhere.
            </p>
        </div>

        <!-- FAQ Item 5 -->
        <div class="bg-white rounded-2xl p-6 shadow-lg border-4 border-yellow-200 hover:border-yellow-400 transition-all">
            <h4 class="text-xl font-kids text-yellow-700 mb-3 flex items-center">
                <span class="text-2xl mr-2">🎁</span>
                Can I request specific coloring pages?
            </h4>
            <p class="text-gray-600 font-semibold">
                We love suggestions! While we can't guarantee every request, we often create new pages
                based on what our community asks for. Send us your ideas!
            </p>
        </div>

        <!-- FAQ Item 6 -->
        <div class="bg-white rounded-2xl p-6 shadow-lg border-4 border-red-200 hover:border-red-400 transition-all">
            <h4 class="text-xl font-kids text-red-700 mb-3 flex items-center">
                <span class="text-2xl mr-2">🖨️</span>
                What's the best paper for printing?
            </h4>
            <p class="text-gray-600 font-semibold">
                Regular printer paper works great! For special projects, try cardstock or heavier paper.
                Make sure your printer settings are set to "high quality" for the best lines.
            </p>
        </div>
    </div>
</div>

<!-- Social Proof & Community -->
<div class="max-w-6xl mx-auto mb-16">
    <div class="bg-gradient-to-r from-pink-100 via-purple-100 to-blue-100 rounded-3xl p-8 shadow-xl border-4 border-white relative overflow-hidden">
        <!-- Decorative elements -->
        <div class="absolute top-4 left-4 text-4xl opacity-30 animate-pulse">💖</div>
        <div class="absolute top-4 right-4 text-3xl opacity-30 animate-bounce">🌟</div>
        <div class="absolute bottom-4 left-4 text-3xl opacity-30 animate-bounce" style="animation-delay: 0.5s;">👨‍👩‍👧‍👦</div>
        <div class="absolute bottom-4 right-4 text-4xl opacity-30 animate-pulse" style="animation-delay: 0.3s;">🎨</div>

        <div class="relative z-10 text-center">
            <h2 class="text-3xl font-kids text-transparent bg-clip-text bg-gradient-to-r from-pink-500 to-purple-600 mb-6">
                💕 What Our Creative Families Say!
            </h2>

            <div class="grid md:grid-cols-3 gap-6 mb-8">
                <!-- Testimonial 1 -->
                <div class="bg-white rounded-2xl p-6 shadow-lg border-2 border-pink-200">
                    <div class="text-4xl mb-3">⭐⭐⭐⭐⭐</div>
                    <p class="text-gray-700 font-semibold mb-3 italic">
                        "My kids absolutely love these coloring pages! The designs are beautiful and there's something for everyone."
                    </p>
                    <p class="text-sm text-purple-600 font-bold">- Sarah, Mom of 3</p>
                </div>

                <!-- Testimonial 2 -->
                <div class="bg-white rounded-2xl p-6 shadow-lg border-2 border-blue-200">
                    <div class="text-4xl mb-3">⭐⭐⭐⭐⭐</div>
                    <p class="text-gray-700 font-semibold mb-3 italic">
                        "As a teacher, I use these daily in my classroom. The quality is amazing and my students are always excited!"
                    </p>
                    <p class="text-sm text-blue-600 font-bold">- Ms. Johnson, 2nd Grade Teacher</p>
                </div>

                <!-- Testimonial 3 -->
                <div class="bg-white rounded-2xl p-6 shadow-lg border-2 border-green-200">
                    <div class="text-4xl mb-3">⭐⭐⭐⭐⭐</div>
                    <p class="text-gray-700 font-semibold mb-3 italic">
                        "Free, high-quality, and family-friendly. This site is a treasure! Thank you for sharing your creativity."
                    </p>
                    <p class="text-sm text-green-600 font-bold">- David, Homeschool Dad</p>
                </div>
            </div>

            <!-- Community Stats -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-white rounded-xl p-4 shadow-md">
                    <div class="text-2xl mb-1">💌</div>
                    <p class="text-2xl font-bold text-purple-600">1000+</p>
                    <p class="text-sm text-gray-600 font-semibold">Messages Received</p>
                </div>
                <div class="bg-white rounded-xl p-4 shadow-md">
                    <div class="text-2xl mb-1">😊</div>
                    <p class="text-2xl font-bold text-blue-600">98%</p>
                    <p class="text-sm text-gray-600 font-semibold">Happy Families</p>
                </div>
                <div class="bg-white rounded-xl p-4 shadow-md">
                    <div class="text-2xl mb-1">⚡</div>
                    <p class="text-2xl font-bold text-green-600">
                        < 24hr</p>
                            <p class="text-sm text-gray-600 font-semibold">Response Time</p>
                </div>
                <div class="bg-white rounded-xl p-4 shadow-md">
                    <div class="text-2xl mb-1">🌍</div>
                    <p class="text-2xl font-bold text-pink-600">150+</p>
                    <p class="text-sm text-gray-600 font-semibold">Countries</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Final Call to Action -->
<div class="max-w-4xl mx-auto text-center">
    <div class="bg-gradient-to-r from-yellow-100 via-green-100 to-blue-100 rounded-3xl p-12 shadow-xl border-4 border-white relative overflow-hidden">
        <!-- Decorative elements -->
        <div class="absolute top-4 left-4 text-4xl opacity-30 animate-pulse">🚀</div>
        <div class="absolute top-4 right-4 text-3xl opacity-30 animate-bounce">💫</div>
        <div class="absolute bottom-4 left-4 text-3xl opacity-30 animate-bounce" style="animation-delay: 0.5s;">🎉</div>
        <div class="absolute bottom-4 right-4 text-4xl opacity-30 animate-pulse" style="animation-delay: 0.3s;">✨</div>

        <div class="relative z-10">
            <h2 class="text-4xl font-kids text-transparent bg-clip-text bg-gradient-to-r from-yellow-500 to-blue-600 mb-6">
                🌈 Ready to Get Creative? 🎨
            </h2>
            <p class="text-xl text-gray-700 font-semibold mb-8 leading-relaxed">
                Don't wait! Send us a message above or dive right into our amazing collection of
                coloring pages. We can't wait to be part of your creative journey!
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="/" class="inline-block bg-gradient-to-r from-yellow-400 via-green-500 to-blue-500 text-white font-bold py-4 px-8 rounded-full hover:from-yellow-500 hover:via-green-600 hover:to-blue-600 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                    🎨 Start Coloring Now! ✨
                </a>
                <button onclick="document.getElementById('message').focus()" class="inline-block bg-gradient-to-r from-pink-400 to-purple-500 text-white font-bold py-4 px-8 rounded-full hover:from-pink-500 hover:to-purple-600 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                    💌 Send Us a Message!
                </button>
            </div>

            <!-- Trust indicators -->
            <div class="mt-8 pt-6 border-t-2 border-white">
                <p class="text-gray-600 font-semibold mb-4">
                    💝 We read and respond to every message with love!
                </p>
                <div class="flex justify-center space-x-4 text-3xl">
                    <span class="animate-bounce">💌</span>
                    <span class="animate-pulse">💖</span>
                    <span class="animate-bounce" style="animation-delay: 0.2s;">🤗</span>
                    <span class="animate-pulse" style="animation-delay: 0.3s;">⚡</span>
                    <span class="animate-bounce" style="animation-delay: 0.4s;">🌟</span>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Enhanced animations */
    @keyframes float {

        0%,
        100% {
            transform: translateY(0px);
        }

        50% {
            transform: translateY(-10px);
        }
    }

    .float-animation {
        animation: float 3s ease-in-out infinite;
    }

    @keyframes wiggle {

        0%,
        100% {
            transform: rotate(0deg);
        }

        25% {
            transform: rotate(1deg);
        }

        75% {
            transform: rotate(-1deg);
        }
    }

    .wiggle:hover {
        animation: wiggle 0.5s ease-in-out;
    }

    /* Gradient text animation */
    @keyframes gradient-text {

        0%,
        100% {
            background-position: 0% 50%;
        }

        50% {
            background-position: 100% 50%;
        }
    }

    .gradient-text-animated {
        background-size: 200% 200%;
        animation: gradient-text 3s ease infinite;
    }

    /* Form enhancements */
    .form-field:focus-within {
        transform: translateY(-2px);
        transition: all 0.3s ease;
    }

    /* Card hover effects */
    .contact-card:hover {
        transform: translateY(-3px) scale(1.02);
        transition: all 0.3s ease;
    }

    /* FAQ accordion animation */
    .faq-item {
        transition: all 0.3s ease;
    }

    .faq-item:hover {
        transform: translateX(5px);
    }

    /* Button ripple effect */
    @keyframes ripple {
        0% {
            transform: scale(0);
            opacity: 1;
        }

        100% {
            transform: scale(4);
            opacity: 0;
        }
    }

    .button-ripple:active::after {
        content: '';
        position: absolute;
        border-radius: 50%;
        background: white;
        transform: scale(0);
        animation: ripple 0.6s linear;
        left: 50%;
        top: 50%;
    }
</style>

<script>
    // Form validation and enhancement
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');
        const inputs = form.querySelectorAll('input, textarea, select');

        // Add floating label effect
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('focused');
            });

            input.addEventListener('blur', function() {
                if (this.value === '') {
                    this.parentElement.classList.remove('focused');
                }
            });
        });

        // Form submission enhancement
        form.addEventListener('submit', function(e) {
            const submitBtn = form.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;

            submitBtn.innerHTML = '🚀 Sending... ✨';
            submitBtn.disabled = true;

            // Reset after 3 seconds (adjust based on your actual form processing)
            setTimeout(() => {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }, 3000);
        });

        // Add fun interactions
        const decorativeElements = document.querySelectorAll('.animate-pulse, .animate-bounce');
        decorativeElements.forEach(el => {
            el.addEventListener('mouseenter', function() {
                this.style.transform = 'scale(1.2)';
                this.style.transition = 'transform 0.3s ease';
            });

            el.addEventListener('mouseleave', function() {
                this.style.transform = 'scale(1)';
            });
        });
    });

    // Smooth scroll to form when "Send Us a Message" button is clicked
    function scrollToForm() {
        document.querySelector('form').scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });
    }
</script>
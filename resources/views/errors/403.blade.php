<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Forbidden Access</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/gsap.min.js"></script>
    <style>
        .animate-float {
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        .glitch {
            position: relative;
        }

        .glitch::before,
        .glitch::after {
            content: "403";
            position: absolute;
            width: 100%;
            height: 100%;
            left: 0;
            top: 0;
        }

        .glitch::before {
            color: #ff8800;
            z-index: -1;
            animation: glitch-effect 2s infinite;
        }

        .glitch::after {
            color: #ff0066;
            z-index: -2;
            animation: glitch-effect 3s infinite;
        }

        @keyframes glitch-effect {
            0% {
                transform: translate(0);
            }

            25% {
                transform: translate(-5px, 2px);
            }

            50% {
                transform: translate(5px, -2px);
            }

            75% {
                transform: translate(2px, 5px);
            }

            100% {
                transform: translate(0);
            }
        }

        .particles {
            position: absolute;
            width: 100%;
            height: 100%;
            z-index: -3;
        }

        .particle {
            position: absolute;
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.5);
        }

        .lock-shape {
            position: relative;
            width: 80px;
            height: 110px;
            margin: 0 auto;
        }

        .lock-body {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 70px;
            background: #ff6b6b;
            border-radius: 12px;
        }

        .lock-hole {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            width: 30px;
            height: 30px;
            background: #1e1e2e;
            border-radius: 50%;
        }

        .lock-arc {
            position: absolute;
            top: -40px;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 50px;
            border: 12px solid #ff6b6b;
            border-bottom: none;
            border-radius: 50px 50px 0 0;
        }

        .pulse {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                transform: translateX(-50%) scale(1);
            }

            50% {
                transform: translateX(-50%) scale(1.1);
            }

            100% {
                transform: translateX(-50%) scale(1);
            }
        }
    </style>
</head>

<body
    class="bg-gradient-to-b from-gray-900 via-purple-900 to-gray-900 text-white min-h-screen flex items-center justify-center relative overflow-hidden">
    <div class="particles" id="particles"></div>

    <div class="container mx-auto px-4 py-10 text-center z-10">
        <div class="mb-8 animate-float">
            <div class="lock-shape">
                <div class="lock-arc pulse"></div>
                <div class="lock-body">
                    <div class="lock-hole"></div>
                </div>
            </div>
        </div>

        <h1 class="text-9xl font-bold mb-4 glitch">403</h1>
        <h2 class="text-3xl font-medium mb-8">Access Forbidden</h2>
        <p class="text-xl text-gray-300 mb-6">You don't have permission to access this resource.</p>
        <p class="text-lg text-gray-400 mb-10">Please check your credentials or contact the administrator if you believe
            this is an error.</p>

        <div class="flex flex-col md:flex-row gap-4 justify-center">
            <a href="/"
                class="px-8 py-3 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition-all duration-300 transform hover:scale-105">
                Back to Home
            </a>
            <a href="/login"
                class="px-8 py-3 bg-transparent border border-gray-400 hover:border-white text-gray-300 hover:text-white font-medium rounded-lg transition-all duration-300">
                Sign In
            </a>
        </div>

        <div class="mt-16 text-gray-500">
            <p>© 2025 Your Company. All rights reserved.</p>
        </div>
    </div>

    <script>
        // Create floating particles
        const particlesContainer = document.getElementById('particles');
        const particleCount = 40;

        for (let i = 0; i < particleCount; i++) {
            const particle = document.createElement('div');
            particle.classList.add('particle');

            const size = Math.random() * 5 + 1;
            particle.style.width = `${size}px`;
            particle.style.height = `${size}px`;

            particle.style.opacity = Math.random() * 0.8 + 0.2;
            particle.style.left = `${Math.random() * 100}%`;
            particle.style.top = `${Math.random() * 100}%`;

            particlesContainer.appendChild(particle);

            animateParticle(particle);
        }

        function animateParticle(particle) {
            const duration = Math.random() * 10 + 10;
            const direction = Math.random() > 0.5 ? 1 : -1;

            gsap.to(particle, {
                x: `${Math.random() * 100 * direction}`,
                y: `${-Math.random() * 100}`,
                duration: duration,
                opacity: 0,
                ease: "none",
                onComplete: () => {
                    // Reset particle
                    gsap.set(particle, {
                        x: 0,
                        y: 0,
                        opacity: Math.random() * 0.8 + 0.2,
                        left: `${Math.random() * 100}%`,
                        top: `${Math.random() * 100}%`
                    });
                    animateParticle(particle);
                }
            });
        }

        // Lock animations
        gsap.fromTo(".lock-body", {
            y: -50,
            opacity: 0
        }, {
            duration: 1,
            y: 0,
            opacity: 1,
            ease: "elastic.out(1, 0.5)"
        });

        gsap.fromTo(".lock-arc", {
            y: -20,
            opacity: 0
        }, {
            duration: 1.2,
            y: 0,
            opacity: 1,
            ease: "elastic.out(1, 0.5)",
            delay: 0.2
        });

        // Text animations
        gsap.from('.glitch', {
            duration: 1,
            y: -50,
            opacity: 0,
            ease: "back.out(1.7)",
            delay: 0.5
        });

        gsap.from('.text-3xl, .text-xl, .text-lg', {
            duration: 1,
            y: 30,
            opacity: 0,
            stagger: 0.2,
            delay: 0.8
        });

        gsap.from('.flex.flex-col', {
            duration: 1,
            y: 30,
            opacity: 0,
            delay: 1.2
        });
    </script>
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Forbidden Realm</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/gsap.min.js"></script>
    <style>
        .fantasy-bg {
            background: radial-gradient(ellipse at bottom, #1B2735 0%, #090A0F 100%);
        }

        .dragon-silhouette {
            position: absolute;
            width: 100%;
            height: 100%;
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 800 500"><path d="M650,300 Q700,250 750,300 T850,250 Q900,200 800,150 Q700,100 650,150 Q600,200 550,150 Q500,100 450,150 Q400,200 350,150 Q300,100 250,150 Q200,200 150,150 Q100,100 50,150 Q0,200 50,250 Q100,300 150,250 Q200,200 250,250 Q300,300 350,250 Q400,200 450,250 Q500,300 550,250 Q600,200 650,250 Z" fill="none" stroke="%23ff6b35" stroke-width="3"/></svg>');
            background-repeat: no-repeat;
            background-position: center;
            opacity: 0.15;
            z-index: 0;
        }

        .spell-circle {
            width: 300px;
            height: 300px;
            border: 2px solid #6b46c1;
            border-radius: 50%;
            position: relative;
            margin: 0 auto 2rem;
            box-shadow: 0 0 25px rgba(107, 70, 193, 0.5);
        }

        .spell-circle::before,
        .spell-circle::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            border: 1px solid transparent;
            border-top-color: #6b46c1;
            animation: spin 15s linear infinite;
        }

        .spell-circle::after {
            border-top-color: #f56565;
            animation-direction: reverse;
            animation-duration: 20s;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .magic-rune {
            position: absolute;
            font-size: 2rem;
            color: #f56565;
            font-family: 'Times New Roman', serif;
        }

        .floating-island {
            position: relative;
            background: linear-gradient(145deg, #2d3748, #1a202c);
            border-radius: 20px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5),
                inset 0 5px 15px rgba(255, 255, 255, 0.1);
            padding: 3rem;
            z-index: 10;
            border: 1px solid #4a5568;
            transform-style: preserve-3d;
        }

        .floating-island::before {
            content: '';
            position: absolute;
            top: -5px;
            left: -5px;
            right: -5px;
            bottom: -5px;
            background: linear-gradient(45deg, #ff6b35, #6b46c1, #4299e1);
            z-index: -1;
            border-radius: 25px;
            opacity: 0.7;
            filter: blur(20px);
        }

        .magic-button {
            background: linear-gradient(45deg, #6b46c1, #805ad5);
            border: none;
            color: white;
            position: relative;
            overflow: hidden;
            transition: all 0.3s;
            box-shadow: 0 5px 15px rgba(107, 70, 193, 0.4);
        }

        .magic-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(107, 70, 193, 0.6);
        }

        .magic-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: 0.5s;
        }

        .magic-button:hover::before {
            left: 100%;
        }

        .sparkle {
            position: absolute;
            width: 5px;
            height: 5px;
            border-radius: 50%;
            background-color: white;
            pointer-events: none;
        }

        .ancient-text {
            font-family: 'Times New Roman', serif;
            color: #d1d5db;
            text-shadow: 0 0 5px rgba(255, 255, 255, 0.3);
        }
    </style>
</head>

<body class="fantasy-bg text-gray-100 min-h-screen flex items-center justify-center overflow-hidden p-4">
    <div class="dragon-silhouette"></div>

    <div class="floating-island max-w-2xl mx-auto text-center">
        <div class="spell-circle">
            <!-- Rune positions -->
            <div class="magic-rune" style="top: 20%; left: 50%; transform: translateX(-50%);">ᚠ</div>
            <div class="magic-rune" style="top: 50%; left: 20%; transform: translateY(-50%);">ᚢ</div>
            <div class="magic-rune" style="top: 50%; right: 20%; transform: translateY(-50%);">ᚦ</div>
            <div class="magic-rune" style="bottom: 20%; left: 50%; transform: translateX(-50%);">ᚨ</div>

            <div class="absolute inset-0 flex items-center justify-center">
                <h1 class="text-8xl font-bold text-purple-400 mb-0">404</h1>
            </div>
        </div>

        <h2 class="text-3xl font-bold text-purple-300 mb-4">Page Not Found</h2>

        <p class="ancient-text text-xl mb-8 leading-relaxed">
            Halaman yang Anda cari mungkin telah dihapus, nama telah diubah, atau tidak tersedia untuk sementara.
        </p>

        <div class="flex flex-col md:flex-row gap-4 justify-center">
            <a href="/" class="magic-button px-8 py-3 rounded-lg font-medium">
                Back to Home
            </a>
            <button id="requestAccess"
                class="px-8 py-3 bg-gray-800 border border-purple-500 text-purple-300 rounded-lg font-medium hover:bg-gray-700 transition">
                Report Issue
            </button>
        </div>

        <div class="mt-10 text-gray-400 ancient-text">
            <p>Scroll of Prohibition • Sealed in the Year of the Phoenix</p>
        </div>
    </div>

    <script>
        // Create magical sparkles
        document.addEventListener('mousemove', function(e) {
            const sparkle = document.createElement('div');
            sparkle.className = 'sparkle';
            sparkle.style.left = e.pageX + 'px';
            sparkle.style.top = e.pageY + 'px';
            document.body.appendChild(sparkle);

            // Random size
            const size = Math.random() * 4 + 2;
            sparkle.style.width = size + 'px';
            sparkle.style.height = size + 'px';

            // Random color
            const colors = ['#f56565', '#4299e1', '#6b46c1', '#f6ad55'];
            sparkle.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];

            // Animate and remove
            gsap.to(sparkle, {
                x: 'random(-20,20)',
                y: 'random(-20,20)',
                opacity: 0,
                duration: 1,
                onComplete: () => sparkle.remove()
            });
        });

        // Animate runes
        const runes = document.querySelectorAll('.magic-rune');
        runes.forEach((rune, i) => {
            gsap.to(rune, {
                y: 'random(-10,10)',
                duration: 'random(3,5)',
                repeat: -1,
                yoyo: true,
                ease: 'sine.inOut',
                delay: i * 0.5
            });
        });

        // Animate spell circle
        const circle = document.querySelector('.spell-circle');
        gsap.to(circle, {
            rotation: 360,
            duration: 120,
            repeat: -1,
            ease: 'none'
        });

        // Button interaction
        document.getElementById('requestAccess').addEventListener('click', function() {
            this.textContent = 'Sending Raven...';
            this.disabled = true;

            setTimeout(() => {
                this.textContent = 'Request Denied!';
                this.classList.add('text-red-400');

                // Create magical explosion effect
                for (let i = 0; i < 20; i++) {
                    const particle = document.createElement('div');
                    particle.className = 'sparkle';
                    particle.style.left = this.getBoundingClientRect().left + this.offsetWidth / 2 + 'px';
                    particle.style.top = this.getBoundingClientRect().top + this.offsetHeight / 2 + 'px';
                    document.body.appendChild(particle);

                    gsap.to(particle, {
                        x: 'random(-100,100)',
                        y: 'random(-100,100)',
                        opacity: 0,
                        duration: 1.5,
                        onComplete: () => particle.remove()
                    });
                }

                setTimeout(() => {
                    this.textContent = 'Request Magical Access';
                    this.classList.remove('text-red-400');
                    this.disabled = false;
                }, 2000);
            }, 1500);
        });

        // Initial animations
        gsap.from('.floating-island', {
            duration: 1.5,
            y: 50,
            opacity: 0,
            ease: 'back.out(1.2)'
        });

        gsap.from('.spell-circle', {
            duration: 1,
            scale: 0,
            opacity: 0,
            ease: 'elastic.out(1, 0.5)',
            delay: 0.5
        });

        gsap.from('h2, p', {
            duration: 1,
            y: 20,
            opacity: 0,
            stagger: 0.2,
            delay: 1
        });
    </script>
</body>

</html>

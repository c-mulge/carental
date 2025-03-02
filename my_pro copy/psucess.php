<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success - Rental Request</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <style>
        :root {
            --primary: #4361ee;
            --primary-dark: #3a0ca3;
            --secondary: #f72585;
            --accent: #7209b7;
            --light: #f8f9fa;
            --dark: #212529;
            --gray: #6c757d;
            --success: #38b000;
            --card-shadow: 0 10px 20px rgba(0,0,0,0.08);
            --hover-shadow: 0 15px 30px rgba(67, 97, 238, 0.15);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
        }

        body {
            background-color: #f0f2f5;
            color: var(--dark);
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        .success-container {
            width: 100%;
            max-width: 450px;
        }

        .success-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: var(--card-shadow);
            padding: 2rem;
            text-align: center;
            transition: transform 0.4s ease, box-shadow 0.4s ease;
            animation: fadeIn 0.6s ease-out;
        }

        .success-card:hover {
            transform: translateY(-12px);
            box-shadow: var(--hover-shadow);
        }

        .success-icon {
            margin: 0 auto 1.5rem;
            width: 80px;
            height: 80px;
        }

        .success-checkmark {
            stroke: var(--success);
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
            animation: checkmark 1s forwards;
            stroke-dasharray: 50;
            stroke-dashoffset: 50;
        }

        .success-title {
            font-size: 1.8rem;
            font-weight: 800;
            margin-bottom: 1rem;
            background: linear-gradient(to right, var(--primary), var(--accent));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .success-message {
            color: var(--gray);
            margin-bottom: 1.5rem;
            font-size: 0.95rem;
        }

        .primary-button {
            display: block;
            width: 100%;
            padding: 0.9rem;
            background: var(--primary);
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.95rem;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(67, 97, 238, 0.2);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .primary-button:hover {
            background: var(--primary-dark);
            box-shadow: 0 6px 15px rgba(67, 97, 238, 0.3);
            transform: translateY(-3px);
        }

        .secondary-button {
            display: block;
            width: 100%;
            padding: 0.9rem;
            background: transparent;
            border: 2px solid var(--primary);
            color: var(--primary);
            text-align: center;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.95rem;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .secondary-button:hover {
            background: rgba(67, 97, 238, 0.1);
            transform: translateY(-3px);
        }

        .button-icon {
            margin-right: 0.5rem;
        }

        .support-text {
            margin-top: 1.5rem;
            text-align: center;
            font-size: 0.9rem;
            color: var(--gray);
        }

        .support-link {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .support-link:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes checkmark {
            0% { stroke-dashoffset: 50; }
            100% { stroke-dashoffset: 0; }
        }

        @keyframes bounce {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        @media (max-width: 480px) {
            .success-card {
                padding: 1.5rem;
            }

            .success-title {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="success-container">
        <div class="success-card">
            <div class="success-icon">
                <svg viewBox="0 0 24 24" fill="none">
                    <path class="success-checkmark" d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                    <polyline class="success-checkmark" points="22 4 12 14.01 9 11.01" />
                </svg>
            </div>

            <h1 class="success-title">
                Booking Confirmed!
            </h1>

            <p class="success-message">
                Great news! Your rental request has been successfully processed. 
                Our team will review your booking and contact you shortly with further details.
            </p>

            <div class="buttons-container">
                <a href="cardetails.php" class="primary-button">
                    <i data-feather="search" class="button-icon"></i>
                    Browse More Cars
                </a>
                <a href="bookings.php" class="secondary-button">
                    <i data-feather="calendar" class="button-icon"></i>
                    View My Bookings
                </a>
            </div>

            <!-- <div class="booking-reference">
                Booking Reference: 
                <span class="reference-number">
                    #<?php //echo rand(10000, 99999); ?>
                </span>
            </div> -->
        </div>

        <div class="support-text">
            Need help? 
            <a href="co.html" class="support-link">
                Contact Support
            </a>
        </div>
    </div>

    <script>
        feather.replace();
    </script>
</body>
</html>
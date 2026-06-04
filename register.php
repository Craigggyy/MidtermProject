<?php

if (isset($_POST['btnRegister']))
{
    $username = $_POST['txtUsername'];
    $password = $_POST['txtPassword'];
    $usertype = $_POST['txtUserType'];

    $exist = false;

    if (file_exists("users.txt"))
    {
        $textcontent = file("users.txt", FILE_IGNORE_NEW_LINES);

        foreach ($textcontent as $index => $linetext)
        {
            if ($username == $linetext)
            {
                $exist = true;
            }
        }
    }

    if ($exist == true)
    {
        echo "<script>
        alert('Username Already Exists');
        </script>";
    }
    else
    {
        $file = fopen("users.txt", "a");

        fwrite($file, $username . "\n");
        fwrite($file, $password . "\n");
        fwrite($file, $usertype . "\n");

        fclose($file);

        echo "<script>
        alert('Account Created Successfully');
        </script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scholara — Create Account</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=DM+Sans:ital,wght@0,300;0,400;0,500;0,600;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">

    <style>
        .register-page {
            min-height: 100vh;
            display: grid;
            grid-template-columns: 1fr 1fr;
            background: var(--white);
        }

        /* ── LEFT PANEL  ── */
        .register-left {
            background: linear-gradient(160deg, var(--red-dark) 0%, var(--red) 55%, #e05a4a 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 72px 64px;
            position: relative;
            overflow: hidden;
        }

        .register-left::before {
            content: '';
            position: absolute;
            top: -90px;
            right: -90px;
            width: 340px;
            height: 340px;
            border-radius: 50%;
            background: rgba(255,255,255,0.07);
            pointer-events: none;
        }

        .register-left::after {
            content: '';
            position: absolute;
            bottom: -110px;
            left: -70px;
            width: 280px;
            height: 280px;
            border-radius: 50%;
            background: rgba(255,255,255,0.05);
            pointer-events: none;
        }

        .register-brand {
            font-family: 'Playfair Display', serif;
            font-size: 2.8rem;
            font-weight: 700;
            color: var(--white);
            line-height: 1.1;
            margin-bottom: 6px;
            position: relative;
            z-index: 1;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .register-brand::before {
            content: '';
            display: inline-block;
            width: 14px;
            height: 14px;
            background: rgba(255,255,255,0.7);
            border-radius: 50%;
            flex-shrink: 0;
            margin-bottom: 2px;
        }

        .register-tagline {
            color: rgba(255,255,255,0.72);
            font-size: 0.98rem;
            font-weight: 300;
            line-height: 1.75;
            position: relative;
            z-index: 1;
            max-width: 340px;
            margin-bottom: 48px;
        }

        .register-features {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 16px;
            position: relative;
            z-index: 1;
        }

        .register-features li {
            display: flex;
            align-items: center;
            gap: 12px;
            color: rgba(255,255,255,0.88);
            font-size: 0.9rem;
            font-weight: 400;
        }

        .register-features li::before {
            content: '✓';
            display: flex;
            align-items: center;
            justify-content: center;
            width: 22px;
            height: 22px;
            background: rgba(255,255,255,0.18);
            border-radius: 50%;
            font-size: 0.7rem;
            font-weight: 700;
            color: var(--white);
            flex-shrink: 0;
        }

        .register-dashes {
            display: flex;
            gap: 8px;
            margin-bottom: 40px;
            position: relative;
            z-index: 1;
        }

        .register-dashes span {
            height: 3px;
            border-radius: 2px;
            background: rgba(255,255,255,0.25);
        }

        .register-dashes span:first-child {
            width: 56px;
            background: rgba(255,255,255,0.75);
        }

        .register-dashes span:nth-child(2) { width: 28px; }
        .register-dashes span:nth-child(3) { width: 16px; }

        /*RIGHT PANEL */
        .register-right {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 60px 72px;
            position: relative;
            overflow: hidden;
        }

        .register-right::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url('images/p1.jpg') center center/cover no-repeat;
            filter: brightness(0.55);
            transform: scale(1.05);
            z-index: 0;
        }

        .register-card {
            width: 100%;
            max-width: 400px;
            position: relative;
            z-index: 1;
            background: rgba(0, 0, 0, 0.4);
            padding: 32px 28px;
            border-radius: 12px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(6px);
        }

        .register-card__heading {
    font-family: 'Playfair Display', serif;
    font-size: 2rem;
    font-weight: 600;
    color: #FFFFFF;
    margin-bottom: 4px;
    line-height: 1.2;
}

.register-card__sub {
    color: #FFFFFF;
    font-size: 0.88rem;
    font-weight: 400;
    margin-bottom: 36px;
    line-height: 1.6;
}

        .register-card .form-group label {
            color: --white: #FFFFFF;
        }

        .register-steps {
            display: flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 32px;
        }

        .register-step {
            width: 28px;
            height: 4px;
            border-radius: 2px;
            background: var(--white-200);
        }

        .register-step.active {
            background: var(--red);
            width: 40px;
        }

        .role-cards {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-top: 4px;
        }

        .role-card {
            border: 1.5px solid var(--gray-200);
            border-radius: 10px;
            padding: 14px 16px;
            cursor: pointer;
            transition: border-color 0.2s, background 0.2s, box-shadow 0.2s;
            background: var(--white);
            display: flex;
            align-items: center;
            gap: 10px;
            user-select: none;
        }

        .role-card:hover {
            border-color: var(--red-light);
            background: var(--red-pale);
        }

        .role-card.selected {
            border-color: var(--red);
            background: var(--red-pale);
            box-shadow: 0 0 0 3px rgba(192,57,43,0.1);
        }

        .role-card__icon {
            font-size: 1.4rem;
            line-height: 1;
        }

        .role-card__label {
            font-size: 0.88rem;
            font-weight: 600;
            color: --white: #FFFFFF;
        }

        .role-card.selected .role-card__label {
            color: var(--red-dark);
        }

        .role-select-hidden {
            display: none;
        }

        .register-signin {
            text-align: center;
            margin-top: 24px;
            font-size: 0.88rem;
            color: var(--gray-500);
        }

        .register-signin a {
            color: var(--red);
            font-weight: 600;
            text-decoration: none;
        }

        .register-signin a:hover {
            text-decoration: underline;
        }

        .register-divider {
            height: 1px;
            background: var(--gray-200);
            margin: 24px 0 20px;
        }


        @media (max-width: 900px) {
            .register-page {
                grid-template-columns: 1fr;
            }

            .register-left {
                padding: 48px 36px 40px;
                min-height: auto;
            }

            .register-brand {
                font-size: 2.2rem;
            }

            .register-features {
                display: none; 
            }

            .register-right {
                padding: 48px 28px;
                background: var(--white);
            }
        }

        @media (max-width: 480px) {
            .register-left {
                padding: 36px 24px;
            }

            .register-right {
                padding: 36px 20px;
            }

            .register-card__heading {
                font-size: 1.65rem;
            }

            .role-cards {
                grid-template-columns: 1fr;
            }
        }

    </style>

</head>

<body>


    <div class="register-page">


        <div class="register-left">

            <div class="register-brand">Scholara</div>

            <p class="register-tagline">
                Your centralised hub for academic modules,<br>
                resources, and learning materials.
            </p>


            <div class="register-dashes">
                <span></span><span></span><span></span>
            </div>


            <ul class="register-features">
                <li>Access course materials anytime</li>
                <li>Upload and share learning resources</li>
                <li>Organised by subject and module</li>
                <li>Secure and role-based access</li>
            </ul>

        </div>

 
        <div class="register-right">

            <div class="register-card">


                <div class="register-steps">
                    <div class="register-step active"></div>
                    <div class="register-step"></div>
                    <div class="register-step"></div>
                </div>

                <h2 class="register-card__heading">Create Account</h2>
                <p class="register-card__sub">Join Scholara and access learning resources.</p>

                <form method="POST">

                    <div class="form-group">
                        <label for="txtUsername">Username</label>
                        <input
                            type="text"
                            id="txtUsername"
                            name="txtUsername"
                            class="form-control"
                            placeholder="Choose a username"
                            autocomplete="username"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="txtPassword">Password</label>
                        <input
                            type="password"
                            id="txtPassword"
                            name="txtPassword"
                            class="form-control"
                            placeholder="Create a password"
                            autocomplete="new-password"
                            required>
                    </div>

        
                    <div class="form-group">
                        <label>Account Type</label>

                        <div class="role-cards" id="roleCards">

                            <div class="role-card selected" data-value="Teacher" tabindex="0" role="button" aria-pressed="true">
                                <span class="role-card__icon">🎓</span>
                                <span class="role-card__label">Teacher</span>
                            </div>

                            <div class="role-card" data-value="Student" tabindex="0" role="button" aria-pressed="false">
                                <span class="role-card__icon">📚</span>
                                <span class="role-card__label">Student</span>
                            </div>

                        </div>

                        <select name="txtUserType" class="role-select-hidden" id="txtUserType">
                            <option value="Teacher">Teacher</option>
                            <option value="Student">Student</option>
                        </select>

                    </div>

                    <input
                        type="submit"
                        name="btnRegister"
                        value="Create Account"
                        class="btn btn-full"
                        style="margin-top: 8px;">

                </form>

                <div class="register-divider"></div>

                <p class="register-signin">
                    Already have an account?
                    <a href="login.php">Sign in</a>
                </p>

            </div>

        </div>

    </div>
    <!-- ai -->
    <script>
        (function () {
            const cards  = document.querySelectorAll('#roleCards .role-card');
            const select = document.getElementById('txtUserType');

            function activate(card) {
                cards.forEach(c => {
                    c.classList.remove('selected');
                    c.setAttribute('aria-pressed', 'false');
                });
                card.classList.add('selected');
                card.setAttribute('aria-pressed', 'true');
                select.value = card.dataset.value;
            }

            cards.forEach(card => {
                card.addEventListener('click', () => activate(card));

                card.addEventListener('keydown', e => {
                    if (e.key === 'Enter' || e.key === ' ') {
                        e.preventDefault();
                        activate(card);
                    }
                });
            });
        })();
    </script>
     <!-- ai -->
</body>

</html>
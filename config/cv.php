<?php

/*
|--------------------------------------------------------------------------
| CV Content
|--------------------------------------------------------------------------
| Everything shown on the website lives here. Edit this file to update
| the site — no need to touch the Blade views.
*/

return [

    'name'     => 'Mohammad Ghaith',
    'title'    => 'Senior Software Developer',
    'tagline'  => 'I build scalable, secure and maintainable enterprise systems — from payroll engines to clean, well-documented APIs.',
    'photo'    => 'images/profile.jpg',

    'contact' => [
        'email'    => 'mohamad.ziad97@gmail.com',
        'phone'    => '+962 7884 54069',
        'phone_raw'=> '+962788454069',
        'location' => 'Amman, Jordan',
    ],

    'whatsapp' => [
        'number'  => '962788454069',   // international format, digits only (no + or spaces)
        'message' => "Hello Mohammad, I found your CV website and I'd like to get in touch.",
    ],

    'linkedin' => [
        'url'         => 'https://www.linkedin.com/in/mohammad-zeyad-280435163/',
        'handle'      => 'in/mohammad-zeyad-280435163',
        // Seconds before the LinkedIn pop-up opens by itself (shown once per visitor). 0 = only on click.
        'popup_delay' => 6,
    ],

    'socials' => [
        // Extra links shown as chips in the Contact section (LinkedIn has its own pop-up above).
        // ['label' => 'GitHub', 'url' => 'https://github.com/your-handle'],
    ],

    'summary' => 'Results-driven Senior Software Developer with over 5 years of hands-on experience in designing, developing, and deploying enterprise-level applications. Proven expertise in backend development using PHP frameworks, database design, and API integrations. Adept at mentoring junior developers, managing project lifecycles, and contributing to agile teams to drive technological growth and business value. Passionate about building scalable and maintainable systems with a keen eye for optimization and security.',

    'stats' => [
        ['value' => '5+',  'label' => 'Years building enterprise software'],
        ['value' => '30%', 'label' => 'Payroll system efficiency gain'],
        ['value' => '10+', 'label' => 'Technologies used in production'],
        ['value' => '2',   'label' => 'Languages spoken fluently'],
    ],

    'highlights' => [
        ['title' => 'Backend Engineering', 'text' => 'PHP (Laravel, CodeIgniter, native) services built on clean MVC and OOP foundations.'],
        ['title' => 'APIs & Integrations', 'text' => 'Secure RESTful integrations between enterprise systems and third-party platforms.'],
        ['title' => 'Data & Performance',  'text' => 'SQL Server and MySQL schema design, query tuning and backend optimization.'],
        ['title' => 'Team Leadership',     'text' => 'Mentoring junior developers, code reviews and Agile/Scrum delivery.'],
    ],

    'experience' => [
        [
            'role'     => 'Senior Software Developer',
            'company'  => 'MenaITech',
            'location' => 'Amman, Jordan',
            'period'   => 'Sep 2019 — Present',
            'current'  => true,
            'points'   => [
                'Led the development and enhancement of the payroll system, improving efficiency by 30%.',
                'Mentored junior developers and ensured high code quality through regular reviews.',
                'Implemented secure API integrations and optimized backend processes.',
                'Migrated legacy systems to modern PHP frameworks.',
            ],
        ],
        [
            'role'     => 'Oracle Development Intern',
            'company'  => 'Civil Consumer Institution',
            'location' => 'Jordan',
            'period'   => 'Jun 2018 — Sep 2018',
            'current'  => false,
            'points'   => [
                'Supported Oracle database administration and integration tasks.',
                'Created internal reports and dashboards for operational use.',
            ],
        ],
    ],

    'education' => [
        [
            'degree' => 'Bachelor of Science in Computer Science',
            'school' => 'Al-Zaytoonah University of Jordan',
            'period' => 'Graduated Oct 2019',
            'note'   => 'GPA 3.2',
        ],
    ],

    'skills' => [
        ['group' => 'Programming Languages',   'items' => ['PHP', 'Laravel', 'CodeIgniter', 'JavaScript', 'HTML5', 'CSS3']],
        ['group' => 'Frameworks & Libraries',  'items' => ['jQuery', 'Bootstrap', 'RESTful APIs']],
        ['group' => 'Databases',               'items' => ['SQL Server', 'MySQL', 'Oracle']],
        ['group' => 'Development Tools',       'items' => ['Git', 'Docker', 'Postman', 'Composer']],
        ['group' => 'Architecture & Concepts', 'items' => ['MVC', 'OOP', 'Agile / Scrum', 'CI/CD']],
        ['group' => 'Soft Skills',             'items' => ['Leadership', 'Team Mentoring', 'Critical Thinking', 'Agile Collaboration']],
    ],

    'languages' => [
        ['name' => 'Arabic',  'level' => 'Native', 'percent' => 100],
        ['name' => 'English', 'level' => 'Fluent', 'percent' => 90],
    ],

];

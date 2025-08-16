@extends('layouts.pages.base')
@section('content')
    <!--==================== HEADER ====================-->
    <header class="header" id="header">
        <nav class="nav container">
            <a href="#home" class="nav_logo">{{ $user->name }}</a>

            <div class="nav_menu" id="nav-menu">
                <ul class="nav_list">
                    <li class="nav-item">
                        <a href="#home" class="nav_link active_link">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="#about" class="nav_link">About</a>
                    </li>
                    <li class="nav-item">
                        <a href="#skills" class="nav_link">Skills</a>
                    </li>
                    <li class="nav-item">
                        <a href="#services" class="nav_link">Services</a>
                    </li>
                    <li class="nav-item">
                        <a href="#portfolio" class="nav_link">Portfolio</a>
                    </li>
                    <li class="nav-item">
                        <a href="#contact" class="nav_link">Contact Me</a>
                    </li>
                </ul>

                <div class="nav_close" id="nav-close">
                    <i class="uil uil-times nav_close"></i>
                </div>
            </div>

            <div class="nav_btns">
                <!--===== THEME CHANGE BUTTON =====-->
                <i class="uil uil-moon change_theme" id="theme-button"></i>

                <div class="nav_toogle" id="nav-toggle">
                    <i class="uil uil-bars"></i>
                </div>
            </div>
        </nav>
    </header>

    <!--==================== MAIN ====================-->
    <main class="main">
        <!--==================== HOME ====================-->
        <section class="home section" id="home">
            <div class="home_container container grid">
                <div class="home_img">
                    @if($user->profile && $user->profile->avatar)
                        <img src="{{ Storage::url($user->profile->avatar) }}" alt="{{ $user->name }}">
                    @else
                        <img src="{{ asset('assets/img/home.png') }}" alt="{{ $user->name }}">
                    @endif
                </div>

                <div class="home_data">
                    <h1 class="home_title">Hi, I'm {{ $user->name }}</h1>
                    @if($user->profile && $user->profile->title)
                        <h3 class="home_subtitle">{{ $user->profile->title }}</h3>
                    @else
                        <h3 class="home_subtitle">FullStack Web developer</h3>
                    @endif
                    @if($user->profile && $user->profile->bio)
                        <p class="home_description">{{ $user->profile->bio }}</p>
                    @else
                        <p class="home_description">High level experience in web design, front-end and backend development, producing quality work.</p>
                    @endif

                    <a href="#contact" class="button button--flex">
                        Contact Me <i class="uil uil-message button__icon"></i>
                    </a>

                    <div class="home_scroll">
                        <a href="#about" class="home_scroll-button button--flex"></a>
                        <i class="uil uil-mouse-alt home_scroll-mouse"></i>
                        <span class="home_scroll-name">Scroll down</span>
                        <i class="uil uil-arrow-down home_scroll-arrow"></i>
                    </div>

                    <div class="home_social">
                        <span class="home_social-follow">Follow Me</span>
                        <div class="home_social-links">
                            @if($user->socials->count() > 0)
                                @foreach($user->socials as $social)
                                    <a href="{{ $social->url }}" target="_blank" class="home_social-icon">
                                        @if($social->icon)
                                            <i class="{{ $social->icon }}"></i>
                                        @else
                                            <i class="uil uil-link"></i>
                                        @endif
                                    </a>
                                @endforeach
                            @else
                                <a href="https://www.linkedin.com" target="_blank" class="home_social-icon">
                                    <i class="uil uil-linkedin-alt"></i>
                                </a>
                                <a href="https://dribbble.com" target="_blank" class="home_social-icon">
                                    <i class="uil uil-dribbble"></i>
                                </a>
                                <a href="https://github.com" target="_blank" class="home_social-icon">
                                    <i class="uil uil-github-alt"></i>
                                </a>
                            @endif
                        </div>
                    </div>

                    <div class="home_scroll_social">
                        <div class="home_scroll1">
                            <a href="#about" class="home_scroll-button button--flex"></a>
                            <i class="uil uil-mouse-alt home_scroll-mouse"></i>
                            <span class="home_scroll-name">Scroll down</span>
                            <i class="uil uil-arrow-down home_scroll-arrow"></i>
                        </div>
                        <div class="home_social1">
                            <div class="home_social-link">
                                @if($user->socials->count() > 0)
                                    @foreach($user->socials as $social)
                                        <a href="{{ $social->url }}" target="_blank" class="home_social-icon">
                                            @if($social->icon)
                                                <i class="{{ $social->icon }}"></i>
                                            @else
                                                <i class="uil uil-link"></i>
                                            @endif
                                        </a>
                                    @endforeach
                                @else
                                    <a href="https://www.linkedin.com" target="_blank" class="home_social-icon">
                                        <i class="uil uil-linkedin-alt"></i>
                                    </a>
                                    <a href="https://dribbble.com" target="_blank" class="home_social-icon">
                                        <i class="uil uil-dribbble"></i>
                                    </a>
                                    <a href="https://github.com" target="_blank" class="home_social-icon">
                                        <i class="uil uil-github-alt"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!--==================== ABOUT ====================-->
        <section class="about section" id="about">
            <h2 class="section__title">About Me</h2>
            <span class="section__subtitle">My introduction</span>

            <div class="about_container container grid">
                @if($user->profile && $user->profile->avatar)
                    <img src="{{ Storage::url($user->profile->avatar) }}" alt="{{ $user->name }}" class="about_img">
                @else
                    <img src="{{ asset('assets/img/about-img.png') }}" alt="{{ $user->name }}" class="about_img">
                @endif

                <div class="about_data">
                    @if($user->profile && $user->profile->about_me)
                        <p class="about_description">{{ $user->profile->about_me }}</p>
                    @else
                        <p class="about_description">FullStack Web developer, with extensive knowledge and years of experience, working in web technologies and UI/UX design, delivering quality work</p>
                    @endif

                    <div class="about_info">
                        <div>
                            <span class="about_info-title">{{ $user->profile->years_experience ?? '08' }}+</span>
                            <span class="about_info-name">Years <br>experience</span>
                        </div>
                        <div>
                            <span class="about_info-title">{{ $user->projects->count() > 0 ? $user->projects->count() : '25' }}+</span>
                            <span class="about_info-name">Completed <br>project</span>
                        </div>
                        <div>
                            <span class="about_info-title">{{ $user->experiences->count() > 0 ? $user->experiences->count() : '04' }}+</span>
                            <span class="about_info-name">Companies <br>worked</span>
                        </div>
                    </div>

                    <div class="about_buttons">
                        @if($user->profile && $user->profile->resume)
                            <a href="{{ Storage::url($user->profile->resume) }}" class="button button--flex" target="_blank">
                                Download CV <i class="uil uil-download-alt button_icon"></i>
                            </a>
                        @else
                            <a href="#" class="button button--flex">
                                Download CV <i class="uil uil-download-alt button_icon"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </section>

        <!--==================== SKILLS ====================-->
        <section class="skills section" id="skills">
            <h2 class="section__title">Skills</h2>
            <span class="section__subtitle">My technical level</span>

            <div class="skills_container container grid">
                @if($user->skills->count() > 0)
                    @php
                        $skillsByCategory = $user->skills->groupBy('category');
                    @endphp

                    @foreach($skillsByCategory as $category => $skills)
                    <div>
                        <div class="skills_content skills_open">
                            <div class="skills_header">
                                <i class="uil uil-brackets-curly skills_icon"></i>
                                <div>
                                    <h1 class="skills_title">{{ $category ?: 'Frontend developer' }}</h1>
                                    <span class="skills_subtitle">More than {{ $skills->count() }} years</span>
                                </div>
                                <i class="uil uil-angle-down skills_arrow"></i>
                            </div>
                            <div class="skills_list grid">
                                @foreach($skills as $skill)
                                <div class="skills_data">
                                    <div class="skills_titles">
                                        <h3 class="skills_name">{{ $skill->name }}</h3>
                                        <span class="skills_number">{{ $skill->proficiency }}%</span>
                                    </div>
                                    <div class="skills_bar">
                                        <span class="skills_percentage skills_{{ strtolower(str_replace(' ', '', $skill->name)) }}" style="width: {{ $skill->proficiency }}%;"></span>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                    {{-- Default skills if none exist --}}
                    <div>
                        <div class="skills_content skills_open">
                            <div class="skills_header">
                                <i class="uil uil-brackets-curly skills_icon"></i>
                                <div>
                                    <h1 class="skills_title">Frontend developer</h1>
                                    <span class="skills_subtitle">More than 4 years</span>
                                </div>
                                <i class="uil uil-angle-down skills_arrow"></i>
                            </div>
                            <div class="skills_list grid">
                                <div class="skills_data">
                                    <div class="skills_titles">
                                        <h3 class="skills_name">HTML</h3>
                                        <span class="skills_number">90%</span>
                                    </div>
                                    <div class="skills_bar">
                                        <span class="skills_percentage skills_html"></span>
                                    </div>
                                </div>
                                <div class="skills_data">
                                    <div class="skills_titles">
                                        <h3 class="skills_name">CSS</h3>
                                        <span class="skills_number">80%</span>
                                    </div>
                                    <div class="skills_bar">
                                        <span class="skills_percentage skills_css"></span>
                                    </div>
                                </div>
                                <div class="skills_data">
                                    <div class="skills_titles">
                                        <h3 class="skills_name">JavaScript</h3>
                                        <span class="skills_number">60%</span>
                                    </div>
                                    <div class="skills_bar">
                                        <span class="skills_percentage skills_javascript"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="skills_content skills_open">
                            <div class="skills_header">
                                <i class="uil uil-server-network skills_icon"></i>
                                <div>
                                    <h1 class="skills_title">Backend developer</h1>
                                    <span class="skills_subtitle">More than 7 years</span>
                                </div>
                                <i class="uil uil-angle-down skills_arrow"></i>
                            </div>
                            <div class="skills_list grid">
                                <div class="skills_data">
                                    <div class="skills_titles">
                                        <h3 class="skills_name">PHP</h3>
                                        <span class="skills_number">80%</span>
                                    </div>
                                    <div class="skills_bar">
                                        <span class="skills_percentage skills_php"></span>
                                    </div>
                                </div>
                                <div class="skills_data">
                                    <div class="skills_titles">
                                        <h3 class="skills_name">Node JS</h3>
                                        <span class="skills_number">80%</span>
                                    </div>
                                    <div class="skills_bar">
                                        <span class="skills_percentage skills_nodejs"></span>
                                    </div>
                                </div>
                                <div class="skills_data">
                                    <div class="skills_titles">
                                        <h3 class="skills_name">Python</h3>
                                        <span class="skills_number">60%</span>
                                    </div>
                                    <div class="skills_bar">
                                        <span class="skills_percentage skills_python"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </section>

        <!--==================== QUALIFICATION ====================-->
        <section class="qualification section">
            <h2 class="section__title">Qualification</h2>
            <span class="section__subtitle">My personal journey</span>

            <div class="qualification_container container">
                <div class="qualification_tabs">
                    <div class="qualificaction_button button--flex qualification_active" data-target="#education">
                        <i class="uil uil-graduation-cap qualification_icon"></i>
                        Education
                    </div>
                    <div class="qualificaction_button button--flex" data-target="#work">
                        <i class="uil uil-briefcase-alt qualification-icon"></i>
                        Work
                    </div>
                </div>

                <div class="qualification_sections">
                    <!--========== QUALIFICATION CONTENT 1 ==========-->
                    <div class="qualification_content qualification_active" data-content id="education">
                        @if($user->education->count() > 0)
                            @foreach($user->education as $education)
                                <div class="qualification_data">
                                    @if($loop->iteration % 2 == 1)
                                        <div>
                                            <h3 class="qualification_title">{{ $education->degree }}</h3>
                                            <span class="qualification_subtitle">{{ $education->institution }}</span>
                                            <div class="qualificaation_calender">
                                                <i class="uil uil-calender-alt"></i>
                                                {{ $education->start_date->format('Y') }} - {{ $education->is_current ? 'Present' : ($education->end_date ? $education->end_date->format('Y') : 'Present') }}
                                            </div>
                                        </div>
                                        <div>
                                            <span class="qualification_rounder"></span>
                                            @if(!$loop->last)<span class="qualification_line"></span>@endif
                                        </div>
                                    @else
                                        <div></div>
                                        <div>
                                            <span class="qualification_rounder"></span>
                                            @if(!$loop->last)<span class="qualification_line"></span>@endif
                                        </div>
                                        <div>
                                            <h3 class="qualification_title">{{ $education->degree }}</h3>
                                            <span class="qualification_subtitle">{{ $education->institution }}</span>
                                            <div class="qualificaation_calender">
                                                <i class="uil uil-calender-alt"></i>
                                                {{ $education->start_date->format('Y') }} - {{ $education->is_current ? 'Present' : ($education->end_date ? $education->end_date->format('Y') : 'Present') }}
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        @else
                            {{-- Default education if none exist --}}
                            <div class="qualification_data">
                                <div>
                                    <h3 class="qualification_title">Computer Science</h3>
                                    <span class="qualification_subtitle">Germany-University</span>
                                    <div class="qualificaation_calender">
                                        <i class="uil uil-calender-alt"></i>
                                        2009 - 2014
                                    </div>
                                </div>
                                <div>
                                    <span class="qualification_rounder"></span>
                                    <span class="qualification_line"></span>
                                </div>
                            </div>
                            <div class="qualification_data">
                                <div></div>
                                <div>
                                    <span class="qualification_rounder"></span>
                                    <span class="qualification_line"></span>
                                </div>
                                <div>
                                    <h3 class="qualification_title">Web Design</h3>
                                    <span class="qualification_subtitle">Germany-Institute</span>
                                    <div class="qualificaation_calender">
                                        <i class="uil uil-calender-alt"></i>
                                        2014 - 2017
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!--========== QUALIFICATION CONTENT 2 ==========-->
                    <div class="qualification_content" data-content id="work">
                        @if($user->experiences->count() > 0)
                            @foreach($user->experiences as $experience)
                                <div class="qualification_data">
                                    @if($loop->iteration % 2 == 1)
                                        <div>
                                            <h3 class="qualification_title">{{ $experience->position }}</h3>
                                            <span class="qualification_subtitle">{{ $experience->company }}</span>
                                            <div class="qualificaation_calender">
                                                <i class="uil uil-calender-alt"></i>
                                                {{ $experience->start_date->format('Y') }} - {{ $experience->is_current ? 'Present' : ($experience->end_date ? $experience->end_date->format('Y') : 'Present') }}
                                            </div>
                                        </div>
                                        <div>
                                            <span class="qualification_rounder"></span>
                                            @if(!$loop->last)<span class="qualification_line"></span>@endif
                                        </div>
                                    @else
                                        <div></div>
                                        <div>
                                            <span class="qualification_rounder"></span>
                                            @if(!$loop->last)<span class="qualification_line"></span>@endif
                                        </div>
                                        <div>
                                            <h3 class="qualification_title">{{ $experience->position }}</h3>
                                            <span class="qualification_subtitle">{{ $experience->company }}</span>
                                            <div class="qualificaation_calender">
                                                <i class="uil uil-calender-alt"></i>
                                                {{ $experience->start_date->format('Y') }} - {{ $experience->is_current ? 'Present' : ($experience->end_date ? $experience->end_date->format('Y') : 'Present') }}
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        @else
                            {{-- Default work experience if none exist --}}
                            <div class="qualification_data">
                                <div>
                                    <h3 class="qualification_title">Software Engineer</h3>
                                    <span class="qualification_subtitle">Apple Inc - Germany</span>
                                    <div class="qualificaation_calender">
                                        <i class="uil uil-calender-alt"></i>
                                        2016 - 2018
                                    </div>
                                </div>
                                <div>
                                    <span class="qualification_rounder"></span>
                                    <span class="qualification_line"></span>
                                </div>
                            </div>
                            <div class="qualification_data">
                                <div></div>
                                <div>
                                    <span class="qualification_rounder"></span>
                                </div>
                                <div>
                                    <h3 class="qualification_title">Frontend Developer</h3>
                                    <span class="qualification_subtitle">Apple Inc - Germany</span>
                                    <div class="qualificaation_calender">
                                        <i class="uil uil-calender-alt"></i>
                                        2018 - 2020
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>

        <!--==================== SERVICES ====================-->
        @if($user->services->count() > 0)
        <section class="services section" id="services">
            <h2 class="section__title">Services</h2>
            <span class="section__subtitle">What I offer</span>

            <div class="services_container container grid">
                @foreach($user->services as $service)
                <div class="services_content">
                    <div>
                        @if($service->icon)
                            <i class="{{ $service->icon }} services_icon"></i>
                        @else
                            <i class="uil uil-web-grid services_icon"></i>
                        @endif
                        <h3 class="services_title">{{ $service->title }}</h3>
                    </div>

                    <span class="button button--flex button--small button--link services_button">
                        View More
                        <i class="uil uil-arrow-right button_icon"></i>
                    </span>

                    <div class="services_modal">
                        <div class="services_modal-content">
                            <h4 class="services_modal-title">{{ $service->title }}</h4>
                            <i class="uil uil-times services_modal-close"></i>

                            <ul class="services_modal-services grid">
                                <li class="services_modal-service">
                                    <i class="uil uil-check-circle services_modal-icon"></i>
                                    <p>{{ $service->description }}</p>
                                </li>
                                @if($service->features && count($service->features) > 0)
                                    @foreach($service->features as $feature)
                                    <li class="services_modal-service">
                                        <i class="uil uil-check-circle services_modal-icon"></i>
                                        <p>{{ $feature }}</p>
                                    </li>
                                    @endforeach
                                @endif
                                @if($service->price)
                                <li class="services_modal-service">
                                    <i class="uil uil-dollar-alt services_modal-icon"></i>
                                    <p>Starting at ${{ number_format($service->price, 2) }}{{ $service->price_type ? ' / ' . $service->price_type : '' }}</p>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
        @endif

        <!--==================== PORTFOLIO ====================-->
        @if($user->projects->count() > 0)
        <section class="portfolio section" id="portfolio">
            <h2 class="section__title">Portfolio</h2>
            <span class="section__subtitle">Most recent work</span>

            <div class="portfolio_container container swiper-container">
                <div class="swiper-wrapper">
                    @foreach($user->projects as $project)
                    <div class="portfolio_content grid swiper-slide">
                        @if($project->image)
                            <img src="{{ Storage::url($project->image) }}" alt="{{ $project->title }}" class="portfolio_img">
                        @else
                            <div class="portfolio_img portfolio_placeholder">
                                <i class="uil uil-image"></i>
                            </div>
                        @endif

                        <div class="portfolio_data">
                            <h3 class="portfolio_title">{{ $project->title }}</h3>
                            <p class="portfolio_description">{{ Str::limit($project->description, 100) }}</p>
                            @if($project->technologies && count($project->technologies) > 0)
                                <div class="portfolio_technologies">
                                    @foreach(array_slice($project->technologies, 0, 3) as $tech)
                                        <span class="portfolio_tech">{{ $tech }}</span>
                                    @endforeach
                                </div>
                            @endif
                            @if($project->demo_url)
                                <a href="{{ $project->demo_url }}" target="_blank" class="button button--flex button--small portfolio_button">
                                    Visit
                                    <i class="uil uil-arrow-right button_icon"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Add Arrows -->
                <div class="swiper-button-next">
                    <i class="uil uil-angle-right-b swiper-portfolio-icon"></i>
                </div>
                <div class="swiper-button-prev">
                    <i class="uil uil-angle-left-b swiper-portfolio-icon"></i>
                </div>

                <!-- Add Pagination -->
                <div class="swiper-pagination"></div>
            </div>
        </section>
        @endif

        <!--==================== PROJECT IN MIND ====================-->
        <section class="project section">
            <div class="project_bg">
                <div class="project_container container grid">
                    <div class="project_data">
                        <h2 class="project_title">You have new project</h2>
                        <p class="project_description">Contact me now and get a 50% discounted</p>
                        <a href="#contact" class="button button--flex button--white">
                            Contact Me
                            <i class="uil uil-message project_icon button_icon"></i>
                        </a>
                    </div>
                    @if($user->profile && $user->profile->avatar)
                        <img src="{{ Storage::url($user->profile->avatar) }}" alt="{{ $user->name }}" class="project_img">
                    @else
                        <img src="{{ asset('assets/img/home.png') }}" alt="{{ $user->name }}" class="project_img">
                    @endif
                </div>
            </div>
        </section>

        <!--==================== TESTIMONIAL ====================-->
        @if($user->testimonials->count() > 0)
        <section class="testimonial section">
            <h2 class="section__title">Testimonial</h2>
            <span class="section__subtitle">My client saying</span>

            <div class="testimonial_container container swiper-container">
                <div class="swiper-wrapper">
                    @foreach($user->testimonials as $testimonial)
                    <div class="testimonial_content swiper-slide">
                        <div class="testimonial_data">
                            <div class="testimonial_header">
                                @if($testimonial->client_avatar)
                                    <img src="{{ Storage::url($testimonial->client_avatar) }}" alt="{{ $testimonial->client_name }}" class="testimonial_img">
                                @else
                                    <img src="{{ asset('assets/img/testimonial1.jpeg') }}" alt="{{ $testimonial->client_name }}" class="testimonial_img">
                                @endif

                                <div>
                                    <h3 class="testimonial_name">{{ $testimonial->client_name }}</h3>
                                    @if($testimonial->client_position || $testimonial->client_company)
                                        <span class="testimonial_client">
                                            @if($testimonial->client_position){{ $testimonial->client_position }}@endif
                                            @if($testimonial->client_position && $testimonial->client_company) at @endif
                                            @if($testimonial->client_company){{ $testimonial->client_company }}@endif
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div>
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="uil uil-star {{ $i <= $testimonial->rating ? 'testimonial_icon-star' : '' }}"></i>
                                @endfor
                            </div>
                        </div>
                        <p class="testimonial_description">{{ $testimonial->content }}</p>
                    </div>
                    @endforeach
                </div>

                <!-- Add Pagination -->
                <div class="swiper-pagination swiper-pagination-testimonial"></div>
            </div>
        </section>
        @endif

        <!--==================== CONTACT ME ====================-->
        <section class="contact section" id="contact">
            <h2 class="section__title">Contact Me</h2>
            <span class="section__subtitle">Get in touch</span>

            <div class="contact_container container grid">
                <div>
                    @if($user->profile)
                        <div class="contact_information">
                            <i class="uil uil-phone contact_icon"></i>
                            <div>
                                <h3 class="contact_title">Call Me</h3>
                                <span class="contact_subtitle">{{ $user->profile->phone ?? 'Not provided' }}</span>
                            </div>
                        </div>

                        <div class="contact_information">
                            <i class="uil uil-envelope contact_icon"></i>
                            <div>
                                <h3 class="contact_title">Email</h3>
                                <span class="contact_subtitle">{{ $user->email }}</span>
                            </div>
                        </div>

                        <div class="contact_information">
                            <i class="uil uil-map-marker contact_icon"></i>
                            <div>
                                <h3 class="contact_title">Location</h3>
                                <span class="contact_subtitle">{{ $user->profile->address ?? 'Not provided' }}</span>
                            </div>
                        </div>
                    @endif
                </div>

                <form method="post" action="{{ route('contact.store', $user) }}#contact" class="contact_form grid" id="contact-form">
                    @csrf
                    <input type="hidden" name="portfolio_user_id" value="{{ $user->id }}">
                    <div class="contact_inputs grid">
                        <div class="contact_content">
                            <label for="name" class="contact_label">Name</label>
                            @error('name')
                                <span class="error">{{ $message }}</span>
                            @enderror
                            <input type="text" class="contact_input" name="name" id="name" value="{{ old('name') }}">
                        </div>
                        <div class="contact_content">
                            <label for="email" class="contact_label">Email</label>
                            @error('email')
                                <span class="error">{{ $message }}</span>
                            @enderror
                            <input type="email" class="contact_input" name="email" id="email" value="{{ old('email') }}">
                        </div>
                    </div>
                    <div class="contact_content">
                        <label for="project" class="contact_label">Project</label>
                        @error('project')
                            <span class="error">{{ $message }}</span>
                        @enderror
                        <input type="text" class="contact_input" name="project" id="project" value="{{ old('project') }}">
                    </div>
                    <div class="contact_content">
                        <label for="description" class="contact_label">Project description</label>
                        @error('description')
                            <span class="error">{{ $message }}</span>
                        @enderror
                        <textarea name="description" id="description" cols="0" rows="7" class="contact_input">{{ old('description') }}</textarea>
                    </div>
                    <div>
                        <button type="submit" class="button button--flex">
                            Send Message
                            <i class="uil uil-message button_icon"></i>
                        </button>
                    </div>
                </form>
            </div>
        </section>
    </main>

    <!--==================== FOOTER ====================-->
    <footer class="footer">
        <div class="footer_bg">
            <div class="footer_container container grid">
                <div>
                    <h1 class="footer_title">{{ $user->name }}</h1>
                    @if($user->profile && $user->profile->title)
                        <span class="footer_subtitle">{{ $user->profile->title }}</span>
                    @else
                        <span class="footer_subtitle">Welcome to my portfolio</span>
                    @endif
                </div>

                <ul class="footer_links">
                    @if($user->services->count() > 0)
                        <li><a href="#services" class="footer_link">Services</a></li>
                    @endif
                    @if($user->projects->count() > 0)
                        <li><a href="#portfolio" class="footer_link">Portfolio</a></li>
                    @endif
                    <li><a href="#contact" class="footer_link">Cantact Me</a></li>
                </ul>

                <div class="footer_socials">
                    @if($user->socials->count() > 0)
                        @foreach($user->socials as $social)
                            <a href="{{ $social->url }}" target="_blank" class="footer_social">
                                @if($social->icon)
                                    <i class="{{ $social->icon }}"></i>
                                @else
                                    <i class="uil uil-link"></i>
                                @endif
                            </a>
                        @endforeach
                    @else
                        <a href="https://www.linkedin.com" target="_blank" class="footer_social">
                            <i class="uil uil-linkedin-alt"></i>
                        </a>
                        <a href="https://dribbble.com" target="_blank" class="footer_social">
                            <i class="uil uil-dribbble"></i>
                        </a>
                        <a href="https://github.com" target="_blank" class="footer_social">
                            <i class="uil uil-github-alt"></i>
                        </a>
                    @endif
                </div>
            </div>

            <p class="footer_copy">&#169; {{ $user->name }}. All right reserved</p>
        </div>
    </footer>

    <!--==================== SCROLL TOP ====================-->
    <a href="#" class="scrollup" id="scroll-up">
        <i class="uil uil-arrow-up scrollup_icon"></i>
    </a>
@endsection

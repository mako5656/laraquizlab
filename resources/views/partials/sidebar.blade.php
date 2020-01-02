@inject('request', 'Illuminate\Http\Request')
<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu"
            data-keep-expanded="false"
            data-auto-scroll="true"
            data-slide-speed="200">

            <li class="{{ $request->segment(1) == 'tests' ? 'active' : '' }}">
                <a href="{{ route('tests.index') }}">
                    <i class="fa fa-pencil-square-o"></i>
{{--                    <span class="title">@lang('quickadmin.test.new')</span>--}}
                    <span class="title">新しい演習問題</span>
                </a>
            </li>

            <li class="{{ $request->segment(1) == 'results' ? 'active' : '' }}">
                <a href="{{ route('results.index') }}">
                    <i class="fa fa-history"></i>
{{--                    <span class="title">@lang('quickadmin.results.title')</span>--}}
                    <span class="title">解答履歴</span>
                </a>
            </li>

            @if(Auth::user()->isAdmin())
            <li class="{{ $request->segment(1) == 'topics' ? 'active' : '' }}">
                <a href="{{ route('topics.index') }}">
                    <i class="fa fa-gears"></i>
                    <span class="title">@lang('quickadmin.topics.title')</span>
                </a>
            </li>
            <li class="{{ $request->segment(1) == 'questions' ? 'active' : '' }}">
                <a href="{{ route('questions.index') }}">
                    <i class="fa fa-gears"></i>
                    <span class="title">@lang('quickadmin.questions.title')</span>
                </a>
            </li>
            <li class="{{ $request->segment(1) == 'questions_options' ? 'active' : '' }}">
                <a href="{{ route('questions_options.index') }}">
                    <i class="fa fa-gears"></i>
                    <span class="title">@lang('quickadmin.questions-options.title')</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span class="title">@lang('quickadmin.user-management.title')</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="{{ $request->segment(1) == 'roles' ? 'active active-sub' : '' }}">
                        <a href="{{ route('roles.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                                @lang('quickadmin.roles.title')
                            </span>
                        </a>
                    </li>
                    <li class="{{ $request->segment(1) == 'users' ? 'active active-sub' : '' }}">
                        <a href="{{ route('users.index') }}">
                            <i class="fa fa-user"></i>
                            <span class="title">
                                @lang('quickadmin.users.title')
                            </span>
                        </a>
                    </li>
                    <li class="{{ $request->segment(1) == 'user_actions' ? 'active active-sub' : '' }}">
                        <a href="{{ route('user_actions.index') }}">
                            <i class="fa fa-th-list"></i>
                            <span class="title">
                                @lang('quickadmin.user-actions.title')
                            </span>
                        </a>
                    </li>
                </ul>
            </li>
            @endif
            <li>
                <a href="{{ url('/home') }}">
                    <i class="fa fa-line-chart"></i>
                    <span class="title">
{{--                        Ability transition--}}
                        能力推移
                    </span>
                </a>
            </li>
            <li>
                <a href="#logout" onclick="$('#logout').submit();">
                    <i class="fa fa-arrow-left"></i>
{{--                    <span class="title">@lang('quickadmin.logout')</span>--}}
                    <span class="title">ログアウト</span>
                </a>
            </li>
        </ul>
        <div class="text-center margin-top-20" style="color: white">
            IKAMI MAKOTO<br>
            <a href="mailto:160441006@ccmailg.meijo-u.ac.jp" target="_blank">160441006@ccmailg.meijo-u.ac.jp</a>
        </div>

{{--        <div class="text-center margin-top-20" style="color: white">--}}
{{--            LaraQuiz is powered by--}}
{{--            <br />--}}
{{--            <a href="https://quickadminpanel.com" target="_blank">QuickAdminPanel.com</a>--}}

{{--            <br /><br />--}}

{{--            Feedback/questions?--}}
{{--            <br />--}}
{{--            <a href="mailto:info@laraveldaily.com" target="_blank">info@laraveldaily.com</a>--}}
{{--        </div>--}}
    </div>
</div>
{!! Form::open(['route' => 'auth.logout', 'style' => 'display:none;', 'id' => 'logout']) !!}
<button type="submit">@lang('quickadmin.logout')</button>
{!! Form::close() !!}

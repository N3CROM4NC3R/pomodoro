@extends("layouts.app")
@section("content")

    {{-- <div class="pomodoro">
        <div class="pomodoro__bar">
            <div class="pomodoro__bar-hollow">
            </div>
        </div>


    </div> --}}
    <div class="pomodoro mx-auto">
        <div class="pomodoro__mode text-white text-center" id="pomodoro-mode">
            Focus
        </div>
        <div class="pomodoro__cycle-count text-white text-center" id="pomodoro-cycle">
            1/4
        </div>
        <div class="pomodoro__count text-white text-center" id="pomodoro-count">
            25:00
        </div>
        <div class="pomodoro__buttons d-flex justify-content-center">
            <div class="pomodoro__control ms-2" id="pomodoro-button">
                <i class="fa-solid fa-play text-white"></i>
            </div>
            <div class="pomodoro__restart ms-2" id="pomodoro-reset">
                <i class="fa-sharp fa-solid fa-arrows-spin text-white"></i>
            </div>
        </div>
    </div>

    <div class="settings" id="settings">
        <div class="settings__close-button text-white d-flex justify-content-end" id="settings-close">
            <i class="fa-sharp fa-solid fa-xmark"></i>
        </div>
        <h1 class="settings__pomodoro text-white text-center">Pomodoro</h1>
        <div class="settings__form-group d-flex justify-content-center align-items-end mb-3">
            <label class="settings__label form-label text-white mb-0">Focus minutes</label>
            <input class="settings__input form-control" id="focus-minutes" type="number" value=25 min=1 max=59/>
        </div>
        <div class="settings__form-group d-flex justify-content-center align-items-end mb-3">
            <label class="settings__label form-label text-white mb-0">Break minutes</label>
            <input class="settings__input form-control" id="break-minutes" type="number" value=5 min=1 max=59>
        </div>
        <div class="settings__form-group d-flex justify-content-center align-items-end mb-3">
            <label class="settings__label form-label text-white mb-0">Long break minutes</label>
            <input class="settings__input form-control" id="long-break-minutes"  type="number" value=15 min=1 max=59>
        </div>
        <div class="settings__form-group d-flex justify-content-center align-items-end">
            <label class="settings__label form-label text-white mb-0">Pomodoros before long break</label>
            <input class="settings__input form-control" id="before-long-break" type="number" min="1" value="4" minlength="1">
        </div>
        <button type="submit" class="custom-btn" id="save-configuration">Save</button>
    </div>

    <div class="statistics mx-auto my-auto" id="stats-modal">
        @guest
        <div class="statistics__login-reminder">
            Watch your statistics by login<br/>
            <a class="custom-btn" href="/login">Login</a>
        </div>
        @else
        <div class="statistics__title text-white text-center">Statistics</div>
        <div class="statistics__button-group d-flex justify-content-between">
            <button class="statistics__button custom-btn">Daily</button>
            <button class="statistics__button custom-btn">Weekly</button>
            <button class="statistics__button custom-btn">Monthly</button>
        </div>

        <div class="statistics__stats" style=";position:relative;width:320px;height:160px;">
            <canvas class="statistics__canvas" id="stats-canvas"></canvas>
        </div>

        <div class="statistics__summary">
            <div class="statistics__summary-title">Summary:</div>
            <div class="statistics__summary-pomodoros">Total pomodoros: <div id="stats-pomodoros">0</div></div>
            <div class="statistics__summary-time">Total time: <div id="stats-time">0</div></div>

        </div>
        @endguest
    </div>

@endsection


@section ("bottom-scripts")
    <script src="/js/pomodoro/pomodoro.js" type="module"></script>
    <script src="/js/settings/settings.js" type="module"></script>
    <script src="/js/pomodoro/statsModal.js" type="module"></script>

    @auth
    <script src="/js/pomodoro/statistics.js" type="module"></script>

    @endauth


@endsection

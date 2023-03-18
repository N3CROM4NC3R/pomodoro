@extends("layouts.app")
@section("content")

    {{-- <div class="pomodoro">
        <div class="pomodoro__bar">
            <div class="pomodoro__bar-hollow">
            </div>
        </div>


    </div> --}}
    <div class="pomodoro mx-auto">
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
            <input class="settings__input form-control" id="before-long-break" type="number" min="1" value="1" minlength="1">
        </div>
    </div>
    <script src="pomodoro.js"></script>

@endsection

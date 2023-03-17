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
    <script src="pomodoro.js"></script>

@endsection

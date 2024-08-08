@extends('user.layout.main')
@section('user-content')
    <div class="content-wrapper">

        <div class="content-header">



            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard </li>
                        </ol>
                    </div>
                </div>
            </div>



            <section class="content">
                <div class="container-fluid">
                    <div class="row">

                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box mb-3">
                               
                                <div class="info-box-content">
                                    <span class="info-box-text"><a href="{{ route('user.order') }}">My Orders</a></span>
                                    <span
                                        class="info-box-number">{{ App\Models\Order::where('user_id', Auth::user()->id)->count() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>




            {{-- <div class="row mt-3">
                <div class="col-lg-12 mb-2">
                    <div class="card  border-0 shadow">
                        <div class="card-header  bg-info">
                            <h4 class="card-title font-weight-normal">Referrer Link</h4>
                        </div>
                        <div class="card-body">
                            <form id="copyBoard">
                                <div class="row align-items-center">
                                    <div class="col-md-10">
                                        <input value="{{ route('user.register', auth()->user()->user_name) }}"
                                            type="url" id="ref" class="form-control form--control from-control-lg"
                                            readonly>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" onclick="myFunction('ref')" id="copybtn"
                                            class="border border-dark btn btn-block "> <span><i class="fa fa-copy"></i>
                                                @lang('Copy')</span></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>


    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel"
        aria-hidden="true">
        <div class="js-container container"
            style="top:0px !important; max-width:100%;display:flex;align-items:center;background:transparent;">

            <div class="modal-dialog onload-screen" role="document">
                <div class="modal-content bg-transparent">
                    <div class="modal-header">
                        <h5 class="modal-title text-white" id="loginModalLabel">Cup Of Deals</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <h1>Congratulations!</h1>
                        <p>Dear <span>{{ ucwords(auth()->user()->name) }}</span><br> Welcome to the Cup of Deals!</p>
                    </div>





                </div>
            </div>
        </div>
    </div>
@endsection

<style>
    .onload-screen {
        z-index: 99999;
        width: 800px !important;
        background: -webkit-linear-gradient(135deg, #ff1053 0%, #3452ff 100%);
    }


    .onload-screen .modal-header {
        border-bottom: 0px;
    }

    .onload-screen .modal-body h1 {
        text-align: center;
        font-size: 2rem;
        color: #fff;
        padding: 7px 20px;
        border-radius: 4px;
        width: fit-content;
        margin: 0px auto;
        margin-bottom: 10px;
        text-transform: uppercase;
        font-weight: 700;
        border: 2px solid;
        /* padding-bottom: 6px; */
        line-height: 47px;
    }




    .onload-screen .modal-body p {
        font-size: 1rem;
        text-align: center;
        color: #fff;
        line-height: 25px;
    }

    .onload-screen .modal-body p span {
        font-weight: 600;
    }

    @keyframes confetti-slow {
        0% {
            transform: translate3d(0, 0, 0) rotateX(0) rotateY(0);
        }

        100% {
            transform: translate3d(25px, 105vh, 0) rotateX(360deg) rotateY(180deg);
        }
    }

    @keyframes confetti-medium {
        0% {
            transform: translate3d(0, 0, 0) rotateX(0) rotateY(0);
        }

        100% {
            transform: translate3d(100px, 105vh, 0) rotateX(100deg) rotateY(360deg);
        }
    }

    @keyframes confetti-fast {
        0% {
            transform: translate3d(0, 0, 0) rotateX(0) rotateY(0);
        }

        100% {
            transform: translate3d(-50px, 105vh, 0) rotateX(10deg) rotateY(250deg);
        }
    }

    .container {
        width: 100vw;
        height: 100vh;
        background: #fff;
        border: 1px solid white;
        display: fixed;
        top: 0px;
    }

    .confetti-container {
        perspective: 700px;
        position: absolute;
        overflow: hidden;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
    }

    .confetti {
        position: absolute;
        z-index: 1;
        top: -10px;
        border-radius: 0%;
    }

    .confetti--animation-slow {
        animation: confetti-slow 2.25s linear 1 forwards;
    }

    .confetti--animation-medium {
        animation: confetti-medium 1.75s linear 1 forwards;
    }

    .confetti--animation-fast {
        animation: confetti-fast 1.25s linear 1 forwards;
    }

    /* Checkmark */
    .checkmark-circle {
        width: 150px;
        height: 150px;
        position: relative;
        display: inline-block;
        vertical-align: top;
        margin-left: auto;
        margin-right: auto;
    }

    .checkmark-circle .background {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        background: #00c09d;
        position: absolute;
    }

    .checkmark-circle .checkmark {
        border-radius: 5px;
    }

    .checkmark-circle .checkmark.draw:after {
        -webkit-animation-delay: 100ms;
        -moz-animation-delay: 100ms;
        animation-delay: 100ms;
        -webkit-animation-duration: 3s;
        -moz-animation-duration: 3s;
        animation-duration: 3s;
        -webkit-animation-timing-function: ease;
        -moz-animation-timing-function: ease;
        animation-timing-function: ease;
        -webkit-animation-name: checkmark;
        -moz-animation-name: checkmark;
        animation-name: checkmark;
        -webkit-transform: scaleX(-1) rotate(135deg);
        -moz-transform: scaleX(-1) rotate(135deg);
        -ms-transform: scaleX(-1) rotate(135deg);
        -o-transform: scaleX(-1) rotate(135deg);
        transform: scaleX(-1) rotate(135deg);
        -webkit-animation-fill-mode: forwards;
        -moz-animation-fill-mode: forwards;
        animation-fill-mode: forwards;
    }

    .checkmark-circle .checkmark:after {
        opacity: 1;
        height: 75px;
        width: 37.5px;
        -webkit-transform-origin: left top;
        -moz-transform-origin: left top;
        -ms-transform-origin: left top;
        -o-transform-origin: left top;
        transform-origin: left top;
        border-right: 15px solid white;
        border-top: 15px solid white;
        border-radius: 2.5px !important;
        content: '';
        left: 25px;
        top: 75px;
        position: absolute;
    }

    @-webkit-keyframes checkmark {
        0% {
            height: 0;
            width: 0;
            opacity: 1;
        }

        20% {
            height: 0;
            width: 37.5px;
            opacity: 1;
        }

        40% {
            height: 75px;
            width: 37.5px;
            opacity: 1;
        }

        100% {
            height: 75px;
            width: 37.5px;
            opacity: 1;
        }
    }

    @-moz-keyframes checkmark {
        0% {
            height: 0;
            width: 0;
            opacity: 1;
        }

        20% {
            height: 0;
            width: 37.5px;
            opacity: 1;
        }

        40% {
            height: 75px;
            width: 37.5px;
            opacity: 1;
        }

        100% {
            height: 75px;
            width: 37.5px;
            opacity: 1;
        }
    }

    @keyframes checkmark {
        0% {
            height: 0;
            width: 0;
            opacity: 1;
        }

        20% {
            height: 0;
            width: 37.5px;
            opacity: 1;
        }

        40% {
            height: 75px;
            width: 37.5px;
            opacity: 1;
        }

        100% {
            height: 75px;
            width: 37.5px;
            opacity: 1;
        }
    }

    .submit-btn {
        height: 45px;
        width: 200px;
        font-size: 15px;
        background-color: #00c09d;
        border: 1px solid #00ab8c;
        color: #fff;
        border-radius: 5px;
        box-shadow: 0 2px 4px 0 rgba(87, 71, 81, .2);
        cursor: pointer;
        transition: all 2s ease-out;
        transition: all 0.2s ease-out;
    }

    .submit-btn:hover {
        background-color: #2ca893;
        transition: all 0.2s ease-out;
    }



    @media only screen and (max-width: 768px) {
        .onload-screen .modal-body h1 {
            font-size: 1.3rem;
        }
    }
</style>

@section('admin-script')
    <script>
        function myFunction(id) {
            var copyText = document.getElementById(id);
            copyText.select();
            copyText.setSelectionRange(0, 99999)
            document.execCommand("copy");
            notify('success', 'Url copied successfully ' + copyText.value);
        }
    </script>


    @if (isset(session()->get('_flash')['old'][0]))
        <script>
            $(document).ready(function() {
                $('#loginModal').modal('show');
            });
        </script>
    @endif



    <script>
        const Confettiful = function(el) {
            this.el = el;
            this.containerEl = null;

            this.confettiFrequency = 3;
            this.confettiColors = ['#EF2964', '#00C09D', '#2D87B0', '#48485E', '#EFFF1D'];
            this.confettiAnimations = ['slow', 'medium', 'fast'];

            this._setupElements();
            this._renderConfetti();
        };

        Confettiful.prototype._setupElements = function() {
            const containerEl = document.createElement('div');
            const elPosition = this.el.style.position;

            if (elPosition !== 'relative' || elPosition !== 'absolute') {
                this.el.style.position = 'relative';
            }

            containerEl.classList.add('confetti-container');

            this.el.appendChild(containerEl);

            this.containerEl = containerEl;
        };

        Confettiful.prototype._renderConfetti = function() {
            this.confettiInterval = setInterval(() => {
                const confettiEl = document.createElement('div');
                const confettiSize = (Math.floor(Math.random() * 3) + 7) + 'px';
                const confettiBackground = this.confettiColors[Math.floor(Math.random() * this.confettiColors
                    .length)];
                const confettiLeft = (Math.floor(Math.random() * this.el.offsetWidth)) + 'px';
                const confettiAnimation = this.confettiAnimations[Math.floor(Math.random() * this
                    .confettiAnimations.length)];

                confettiEl.classList.add('confetti', 'confetti--animation-' + confettiAnimation);
                confettiEl.style.left = confettiLeft;
                confettiEl.style.width = confettiSize;
                confettiEl.style.height = confettiSize;
                confettiEl.style.backgroundColor = confettiBackground;

                confettiEl.removeTimeout = setTimeout(function() {
                    confettiEl.parentNode.removeChild(confettiEl);
                }, 3000);

                this.containerEl.appendChild(confettiEl);
            }, 25);
        };

        window.confettiful = new Confettiful(document.querySelector('.js-container'));
    </script>
@endsection

@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div id="cloader" class="vertical-align app-panel">
                <div class="horizontal-align text-center">

                    <div class="loader">
                        <svg>
                            <defs>
                                <filter id="goo">
                                    <feGaussianBlur in="SourceGraphic" stdDeviation="2" result="blur"/>
                                    <feColorMatrix in="blur" mode="matrix"
                                                   values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 5 -2"
                                                   result="gooey"/>
                                    <feComposite in="SourceGraphic" in2="gooey" operator="atop"/>
                                </filter>
                            </defs>
                        </svg>
                    </div>
                    <div style="margin-top: 120px">
                        <h5>Analyzing your profile</h5>
                    </div>
                </div>
            </div>


            <div id="content" class="fbapp" style="display: none">
                <div style="height: 100%;position: relative;">
                    <div class="imgcontainer"
                         style="">
                    </div>
                    <div id="img"
                         style="width: 100%;     color: white; background: #212121;  bottom: 0; padding: 30px 10px 30px  10px;"
                         class=" text-center vertical-align">
                        <div style="width: 100%">
                            <h2 style="margin-top: 0" id="title"></h2>
                            <h5 id="desc"></h5>
                            <div class="fbcontainer">
                                <a onclick="onShareClick()">
                                    <div class="fb-icon-bg"></div>
                                    <div class="fb-bg"></div>
                                </a>
                                <div style=" width: 100%;text-align: center;">
                                    <a id="retry" class="btn btn-round btn-primary" style="margin-top: 20px"
                                       onclick="shuffle()">
                                        Try Again!
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @section('facebook_meta')
            <meta property="og:image"
                  content="{{ json_decode( '{' . $appData .'}',true)['arr'][$safeResultId]['image']  }}">
            <meta property="og:description"
                  content="{{  $app->og_description  }}">
            <meta property="og:title"
                  content="{{ $app->og_title_prefix  }}">
            <meta property="og:type" content="product">
        @endsection

        <script>

            var data ={{!! ($appData) !!}};
            data = data.arr;
            var selectedInd = 0;
            var retry =
            {{$retry}}

            if (!retry) {
                $('#retry').hide();
            }

            function shuffle() {
                var ind = Math.floor(Math.random() * data.length);
                setUi(ind);
                selectedInd = ind;
            }

            function setUi(ind) {
                var item = data[ind];
                $('#title').text(item.title);
                $('#desc').text(item.desc);
                $('.imgcontainer').css('background-image', 'url(' + item.image + ')');
            }

            function onShareClick() {
                FB.ui({
                    method: 'share',
                    display: 'popup',
                    href: '{{env('APP_URL')}}' + '/fbappresult?result=' + selectedInd + '&fbid=' + userid + '&appid=' + '{{$app->id}}',
                }, function (response) {
                });
            }

            var userid =
                    {{Auth::user()->fbid}}
            var urlId = '{{$resultId}}';
            var urlId = parseInt(urlId);
            if (urlId == -1) {
                shuffle()
                setUi(selectedInd);
            } else {
                setUi(urlId);
                selectedInd = urlId;
            }
        </script>

        <script>
            window.addEventListener('load',
                function () {
                    setTimeout(function () {
                        $('#content').show();
                        $('#cloader').hide();
                    }, 3000);
                }, false);
        </script>
@endsection

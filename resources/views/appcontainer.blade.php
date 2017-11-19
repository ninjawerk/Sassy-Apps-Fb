@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="fbapp">
                <div style="height: 100%;position: relative;">
                    <div class="imgcontainer"
                         style="">
                        <div style="position: absolute; bottom: 15px;width: 100%;text-align: center;">
                            <a id="retry" class="btn btn-round btn-primary" style="margin-top: 20px"
                               onclick="shuffle()">
                                Retry
                            </a>
                        </div>
                    </div>
                    <div id="img"
                         style="width: 100%;height: 30%;    color: white; background: #212121; position: absolute; bottom: 0"
                         class=" text-center vertical-align">
                        <div style="width: 100%">
                            <h2 style="margin-top: 0" id="title"></h2>
                            <h5 id="desc"></h5>
                            <div class="fbcontainer">
                                <a onclick="onShareClick()">
                                    <div class="fb-icon-bg"></div>
                                    <div class="fb-bg"></div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@section('facebook_meta')
    <meta property="og:url" content="{{env('APP_URL') . '?fbid=' . $app->id}}">
    <meta property="og:image" content="{{ json_decode( '{' . $appData .'}',true)['arr'][$safeResultId]['image']  }}">
    <meta property="og:description" content="{{ json_decode( '{' . $appData .'}',true)['arr'][$safeResultId]['desc']  }}">
    <meta property="og:title" content="{{ json_decode( '{' . $appData .'}',true)['arr'][$safeResultId]['title']  }}">
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
            href: '{{env('APP_URL')}}' + '/fbapp?result=' + selectedInd + '&fbid=' + userid + '&fbid=' + {{$app->id}},
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
@endsection

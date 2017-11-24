@extends('layouts.app')

@section('content')

    <div class="row" style="margin-bottom: 100px">

        <form method="post" action="/adminsave">
            {{ csrf_field() }}
            <h3 style="margin-top: 40px">App Info</h3>
            <hr/>

            <div class="form-group">
                <label for="appname">App Name</label>
                <input type="text" class="form-control" id="appname" name="title" required>
            </div>
            <div class="form-group">
                <label for="desc">Description</label>
                <textarea type="text" name="desc" class="form-control" id="desc" required></textarea>
            </div>
            <div class="form-group">
                <label for="iconurl">Icon Url</label>
                <input type="text" class="form-control" id="iconurl" name="iconurl" required>
            </div>
            <div class="form-group">
                <label for="jsondata">Data</label>
                <textarea type="text" name="jsondata" class="form-control" id="jsondata" required></textarea>
            </div>


            <h3 style="margin-top: 40px">Facebook Data</h3>
            <hr/>

            <div class="form-group">
                <label for="fbsharetitle">Facebook Share Title</label>
                <input type="text" class="form-control" id="fbsharetitle" name="fbsharetitle" required>
            </div>
            <div class="form-group">
                <label for="fbsharedescription">Facebook Share Description</label>
                <input type="text" class="form-control" id="fbsharedescription" name="fbsharedescription" required>
            </div>

            <h3 style="margin-top: 40px">App Options</h3>
            <hr/>
            <div class="checkbox">
                <label><input type="checkbox" name="retry">Show Retry Button</label>
            </div>
            <button style="margin-top: 40px" type="submit" class="btn btn-success btn-lg">Save</button>


        </form>
    </div>

@endsection

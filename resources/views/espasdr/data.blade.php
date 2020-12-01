@extends('layouts.app')
@section('content')

    <div class="container">
        <br>
        <br>
        <div class="row">
            <div class="col-md-12 centered">
                <div class="col-md-8">
                    <form class="form-inline">
                        <div class="form-group">
                            <label><h3>Person </h3></label>
                            <a href="{{ route('add') }}">
                                <button type="button" class="btn btn-success">Add Data</button>
                            </a>
                        </div>
                    </form>
                </div>

                <table id="datas-list" name="datas-list">
                    <thead>
                    <tr>
                        <th>foo</th>
                        <th>foo</th>
                        <th>foo</th>
                        <th>foo</th>
                        <th>foo</th>
                        <th>foo</th>
                        <th>foo</th>
                    </tr>
                    </thead>
                    <tbody>

                    <table class='items'>
                        <thead>
                        <tr>
                            <th>Column 1</th>
                            <th>Column 2</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($datas as $config)

                            <tr class='item-row'>
                                <td class='item'> {{ $config->nodeValue }} </td>
                            </tr>
                        @endforeach
                        @foreach($brood as $general)

                            <tr class='item-row'>
                                <td class='item'> {{ $general->nodeValue }} </td>
                            </tr>
                        @endforeach


                        </tbody>
                    </table>
                    </tbody>
                </table>
            </div>
        </div>
        <br>
        <br>
    </div>

    <script>
        const coll = document.getElementsByClassName("collapsible");
        let i;

        for (i = 0; i < coll.length; i++) {
            coll[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var content = this.nextElementSibling;
                if (content.style.display === "block") {
                    content.style.display = "none";
                } else {
                    content.style.display = "block";
                }
            });
        }
    </script>

@endsection

@extends('layouts.default')
@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <h1>Firefly
            <small>Overview for account "{{{$account->name}}}"</small>
        </h1>
    </div>
</div>

@include('partials.date_nav')

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
            <div id="chart"></div>
        </div>
    </div>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <h4>Summary <small>For selected account and period</small></h4>

    </div>
</div>
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-12">

        <table class="table table-striped table-condensed">
            <tr>
                <th></th>
                <th>Expense / income</th>
                <th>Transfers</th>
            </tr>
            <tr>
                <td>Out</td>
                <td>
                    {{mf($show['statistics']['period']['out'])}}
                    <a href="{{route('accounts.show',$account->id)}}#transactions-thisaccount-this-period-expensesonly"><span class="glyphicon glyphicon-circle-arrow-right"></span></a>
                </td>
                <td>
                    {{mf($show['statistics']['period']['t_out'])}}
                    <a href="#transactions-thisaccount-this-period-transfers-out-only"><span class="glyphicon glyphicon-circle-arrow-right"></span></a>
                </td>
            </tr>
            <tr>
                <td>In</td>
                <td>
                    {{mf($show['statistics']['period']['in'])}}
                    <a href="#transactions-thisaccount-this-period-incomeonly"><span class="glyphicon glyphicon-circle-arrow-right"></span></a>
                </td>
                <td>
                    {{mf($show['statistics']['period']['t_in'])}}
                    <a href="#transactions-thisaccount-this-period-transfers-in-only"><span class="glyphicon glyphicon-circle-arrow-right"></span></a>
                </td>
            </tr>
            <tr>
                <td>Difference</td>
                <td>{{mf($show['statistics']['period']['diff'])}}</td>
                <td>{{mf($show['statistics']['period']['t_diff'])}}</td>
            </tr>
            </table>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12">
        <table class="table table-striped table-condensed">
            <tr>
                <td style="width:30%;">Related accounts</td>
                <td>
                    @foreach($show['statistics']['accounts'] as $acct)
                    <a href="{{route('accounts.show',$acct->id)}}" class="btn btn-default btn-xs">{{{$acct->name}}}</a>
                    @endforeach
                </td>
            </tr>
            <tr>
                <td>Related categories</td>
                <td>
                    @foreach($show['statistics']['categories'] as $cat)
                    <a href="#category-overview" class="btn btn-default btn-xs">{{{$cat->name}}}</a>
                    @endforeach
                </td>
            </tr>
            <tr>
                <td>Related budgets</td>
                <td>
                    @foreach($show['statistics']['budgets'] as $bud)
                    <a href="#budget-overview" class="btn btn-default btn-xs">{{{$bud->name}}}</a>
                    @endforeach
                </td>
            </tr>
        </table>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">


        <h4>Transactions <small> For selected account and period</small></h4>
        @include('paginated.transactions',['journals' => $show['journals']])
    </div>
</div>

@stop

@section('styles')
<?php echo stylesheet_link_tag('accounts'); ?>
@stop

@section('scripts')
<script type="text/javascript">
    var accountID = {{$account->id}};
</script>
<?php echo javascript_include_tag('accounts'); ?>
@stop
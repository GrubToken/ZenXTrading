<table class="table table-bordered">
    <thead>
    <tr>
        <th>Source</th>
        <th>Balance</th>
    </tr>
    </thead>
    <tbody>
        <tr>
            <td>Paypal</td>
            <td><big>$ {{ $usdfunds != null ? $usdfunds->funds_remaining : 0 }} USD</big><button type="button" class="btn btn-primary exchange-btn"><i>ɃTC Exchange</i></button></td>
        </tr>
        <tr>
            <td>(wallet-addr)</td>
            <td><big>Ƀ0.00 ɃTC</big><button type="button" class="btn btn-primary exchange-btn"><i>USD Exchange</i></button></td>
        </tr>
    </tbody>
</table>

<div class="col-md-12" style="margin-top: 10px; margin-bottom: 10px;">
    <!-- /Exchange/BTC-USD/Submit/buy:0@3:0/false -->

    <select name="currency" class="col-md-3">
        <option>I want to exchange...</option>
        <option value="buy">USD for ɃTC</option>
        <option value="sell">ɃTC for USD</option>
    </select>

    <input type="text" name="shares" class="col-md-2" placeholder="# of shares" />
    <input type="text" name="bid" class="col-md-2"  placeholder="Bid price" />
    <input type="hidden" name="margin" class="col-md-2"  value="0" />
    <input type="submit" class="submit-exchange" class="col-md-2"  value="Exchange" />
</div>

<table class="table table-bordered">
	<thead>
	<tr>
		<th>Buy/Sell</th>
		<th>Ƀitcoin</th>
		<th>Bid</th>
        <th>Filled</th>
        <th>Status</th>
	</tr>
	</thead>
	<tbody>
		@foreach($my_orders as $order)
		<tr>
			<td>{{ $order->way }}</td>
			<td><small>Ƀ</small> {{ $order->request_amount - $order->filled }}</td>
			<td><small>$</small> {{ $order->bid }}</td>
            <td><small>$</small> {{ $order->filled }}</td>
            <td>{{ $order->filled == 0 ? "<button class='button button-primary cancel-order-button' data-id='{{ $order->id }}'>Cancel</button>" : "Active" }} </td>
		</tr>
		@endforeach
	</tbody>
</table>

<script>
    $(document).ready(function(){
        $(".submit-exchange").click(function(){
            $.get("/exchange/public/index.php/Exchange/BTC-USD/Submit/" + $("select[name='currency']").val() + ":" + $("input[name='shares']").val() + "@" + $("input[name='bid']").val() + ":0/", function(){
                window.location = '/exchange/public/index.php/home';
            });
        });

        $(".cancel-order-button").click(function(){
            var button = $(this);
            $.get("/exchange/public/index.php/Exchange/CancelRequest/", {id: button.attr("data-id")}, function(){
                window.location = '/exchange/public/index.php/home';
            });
        });
    });
</script>
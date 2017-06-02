<table border="1">
    <tr>
        <td colspan="2">
            <img src="{$this_path_paygol}views/img/index_logo_main.png" alt="{l s='Paygol' mod='paygol'}" style="float:left; margin: 0px 10px 5px 0px;" />
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<h2>{l s='Order Summary' mod='paygol'}</h2>
			<h3>{l s='Paygol' mod='paygol'}</h3>
			<p>
				{l s='You will pay using Paygol.' mod='paygol'}
				
				<!-- {l s='The total of your order is' mod='paygol'}
				<span id="amount_{$currencies.0.id_currency}" class="price">{convertPrice price=$total}</span>
				{if $use_taxes == 1}
					{l s='(tax incl.)' mod='paygol'}
				{/if} -->
				
			</p>
		</td>
	</tr>
	<tr>
		<td>
			<form name="pg_frm" id="pg_frm" method="post" action="https://www.paygol.com/pay">
				<input type="hidden" name="pg_serviceid" value="{$serviceid}">
				<input type="hidden" name="pg_currency" value="{$currency->iso_code}">
				<input type="hidden" name="pg_name" value="{$shop_name} Order #{$cart_id}">
			    <input type="hidden" name="pg_custom" value="{$cart_id}-{$customerid}-{$skey}">
				<input type="hidden" name="pg_price" value="{$total}">
				<input type="hidden" name="pg_return_url" value="{$base_dir_ssl}modules/paygol/validation.php">
				<input type="hidden" name="pg_cancel_url" value="{$link->getPageLink('order', true)}?step=3">
				<table border="1" style="width:100%">
					  <tr>
					    <th>{l s='Total' mod='paygol'}</th>
						 <th>{l s='Payment method' mod='paygol'}</th>
					  </tr>
					  <tr>
						<td><span id="amount_{$currencies.0.id_currency}" class="price">{convertPrice price=$total}</span></td>
						<td>Paygol</td>
					  </tr>
					  <tr>
					<td><a href="{$link->getPageLink('order', true)}?step=3" class="button_large">{l s='Other payment methods' mod='paygol'}</a></td>
					<td><input type="submit" name="pg_button" id="pg_button" value="{l s='Confirm order' mod='paygol'}" class="exclusive_large" /></td>
					</tr>
				</table>
			</form>
			<script type="text/javascript">
			$('#pg_button').click(
			function()
			{
			$.ajax(
			{
				type : 'GET',
				url : './payment.php?create-pending-order',
				dataType: 'html',
				success: function(data)
				{
					$('#pg_frm').submit();
				}
			});
			}
			);
			</script>
		</td>
	</tr>
</table>
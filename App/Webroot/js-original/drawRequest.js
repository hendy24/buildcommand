$(document).ready(function() {
		var i = $(".new-payee").length;
		$("#dialog").hide();
		$("delete-dialog").hide();
		var profitMargin = $("#profit-margin").val();
		var $marginItem = $("#margin");


		$(".delete").click(function(e) {
			e.preventDefault();
			var dataRow = $(this).parent().parent();
			var id = $(this).attr("id");
			
			var margin = $marginItem.val();
			var delVal = dataRow.find(".amount").val();
			var newMargin = margin - (delVal * profitMargin);

			$("#delete-dialog").dialog({
				buttons: {
					"Remove": function() {
						$.ajax({
							type: 'post',
							url: SITE_URL,
							data: {
								page: 'draw_requests',
								action: 'remove_item',
								id: id
							},
							success: function() {
								dataRow.fadeOut("slow");
								$marginItem.val(newMargin);
							}
						});
						$(this).dialog("close");	
					},
					"Cancel": function() {
						$(this).dialog("close");
					}
				}

			});
			
		});


				// Update the profit margin item
		$(".amount").focus(function() {			
			var margin = $marginItem.val();
			var amount = $(this).val();
			var origItemMargin = amount * profitMargin;

			$(this).blur(function() {
				// Remove the original item margin from the existing margin
				var newMargin = margin - origItemMargin;
				// Get new item amount
				var newAmount = $(this).val();
				// Calculate profit margin from new amount
				var itemMargin = newAmount * profitMargin;
				// Add new item margin to the new margin
				margin = (newMargin * 1) + (itemMargin * 1);

				$marginItem.val(margin.toFixed(2));
			});			
		});





		function cloneRow(button) {
			var $tr = button.parent().parent();
			var $clone = $tr.clone();

			$clone.find(':text').val('');
			$tr.removeClass('add-row');
			$tr.after($clone);

			$payee = $clone.find(".payee");
			$newPayee = $clone.find(".new-payee");
			$sectionItem = $clone.find(".section-item");
			$amount = $clone.find(".amount");

			$newPayee.attr("name", "new_payee[" + i + "]");
			$amount.attr("name", "amount[" + i + "]");

			return $clone;
		}

		$("#submit-request").on('click', 'input.new-payee', function() {
			$clonedRow = cloneRow($(this));
			$payee = $clonedRow.find(".payee");
			$sectionItem = $clonedRow.find(".section-item");

			var count = i - 1;

			$payee.attr("name", "payee[" + count + "]");
			$sectionItem.attr("name", "section_item[" + count + "]");
			i++;


			$(".payee-search").autocomplete({
				serviceUrl: SITE_URL,
				params: {
					page: 'Company',
					action: 'searchNames'
				}, minChars: 3,
				width: "300",
				onSelect: function (suggestion) {
					$payee.val(suggestion.data);
				}
			});

			$(".section-item-search").autocomplete({
				serviceUrl: SITE_URL,
				params: {
					page: 'SectionItems',
					action: 'searchItems'
				}, minChars: 3,
				width: "300",
				onSelect: function (suggestion) {
					$sectionItem.val(suggestion.data);
				}
			});
		});


		// Save the draw request
		$("#save").click(function(e) {
			e.preventDefault();
			data = $("#submit-request").serialize();
			window.location = SITE_URL + "/?" + data + "&type=save";
		});

		$("#submit-request").submit(function(e) {
			e.preventDefault();
			$("#dialog").dialog({
				buttons: {
					"Submit": function() {
						data = $("#submit-request").serialize();
						window.location = SITE_URL + "/?" + data + "&type=submit";
					},
					"Cancel": function() {
						$(this).dialog("close");
					}
				}
			});
		});

	});
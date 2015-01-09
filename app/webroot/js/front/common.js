$(document).ready(function() {

	$(".go_to_link").click(function(e) {
		//e.preventDefault();
		var lid = $(this).attr("lid");
		$.ajax({
			url: Rootsiteurl+"leads/hit_leads",
			type: "post",
			data: {lid: lid, action: "viewed"},
			success: function(data) {

			}
		});
	});

	$(".opentab_chk").click(function() {
		var clid = $(this).attr("clid");
		$(".open" + clid).toggle();
	});
	$(document).on('click', '.change_status', function(e) {

		var lid = $(this).attr("lid");
		var status = $(this).attr("status");

		if (status != 5) {
			$('#next_id_set' + lid).html("<img src='"+Rootsiteurl+"img/loading.GIF'>");

			$.ajax({
				url: Rootsiteurl+"leads/hit_leads",
				type: "post",
				data: {lid: lid, status: status, action: "status"},
				success: function(data) {

					var statusobj = {s1: "Open bid", s2: "Bid Placed", s3: "Declined", s4: "Feedback", s5: "Project start"};
					constatus = parseInt(status) + parseInt(1);

					//alert(constatus);
					html_in = '';
					for (i = 1; i < constatus; i++) {
						if (i == parseInt(constatus) - parseInt(1)) {
							txtdecostyle = "text-decoration:none";
						} else {
							txtdecostyle = "text-decoration:line-through;color:#A9A9A9;";
						}
						if (i == 3) {
							continue;
						}
						html_in = html_in.concat("<span style=" + txtdecostyle + ">" + statusobj["s" + i] + "</span><br/>");

					}
					if (status == 3) {
						html_in = html_in.concat("<span style='text-decoration:none'>Declined</span><br/>");

					}
					$('#mainTxt' + lid).html(html_in);

					next_status = {n1: {s2: "Bid Placed"}, n2: {s3: "Declined", s4: "Feedback"}, n3: {}, n4: {s5: "Project Start"}};
					colorcodeArray = {s2: "btn btn-small btn-info", s3: "btn btn-small btn-danger change_status", s4: "btn btn-small btn-warning change_status", s5: "btn btn-small btn-success change_status"};

					//alert(next_status['n1']['s2']);

					txt_in_next = '';
					Object.keys(next_status["n" + status]).forEach(function(item) {
						resid = item.slice(1);

						txt_in_next = txt_in_next.concat("<p><button class='change_status " + colorcodeArray[item] + "' lid=" + lid + " status=" + resid + ">" + next_status["n" + status][item] + "</button></p>");
					});
					$("#next_id_set" + lid).html(txt_in_next);
				}
			});

		} else {

			$("#ProjectIndexForm").append("<input type='hidden' name=data[Project][lead_id] value=" + lid + ">");
			$('#StartProjectModal').modal('show');
			$('.popover-dismiss').popover({html: true});
		}

	});




	jQuery("#add_new_project_lead").validationEngine();


});

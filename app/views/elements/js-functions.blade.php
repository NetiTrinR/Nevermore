function updateServerStatus(){
	$.ajax({
		type:"GET",
		url: "{{URL::to('/serverstatus')}}",
		success: function(output){
			$('#serverStatus').html('Hostname: '+output.HostName+'<br />Version: '+output.Version+'<br />Currently online: '+output.Players+'/'+output.MaxPlayers);
		}
	})
}
function updateChosenTags(){
	$.ajax({
		type:"GET",
		url: "{{URL::to('/forum/chosenTags')}}",
		success: function(output){
			$('#chosenTags').html(output);
			$("#chosenTags").trigger("chosen:updated");
		}
	});
}
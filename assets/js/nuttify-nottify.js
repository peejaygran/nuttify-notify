var $ = jQuery;

$(document).ready(function(){
	
	var $ = jQuery;
	var post_type = typenow;

	if(post_type == nut_post_value){
		
		try{
			var msg = $("#message p:eq(0)").text();
			
			if(msg.indexOf("updated") > -1 || msg.indexOf("publish") > -1){
				
				var status = "";
				if(msg.indexOf("updated") > -1){
					status = "update";
				}
				else{
					status = "publish";
				}
				
				var post_title = $("#title").val();
				var post_author = $("#post_author").val();
				
				var data = {
					'action': 'nut_email_process',
					'status': status,
					'post_title': post_title,
					'post_author': post_author
					
				};
				// We can also pass the url value separately from ajaxurl for front end AJAX implementations
				$.post(ajaxurl, data, function(response) {
					
				});
			
			}
			
			
		}catch(err){
			
		}
		
	}
	
	
});

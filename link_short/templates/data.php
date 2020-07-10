<!DOCTYPE html>  
<html lang="en">  
<head>  
    <meta charset="UTF-8">  
    <title>login</title>  
    {% load static %}  
    <link href="{% static '/bootstrap.min.css' %}" rel="stylesheet">  
     
</head>  
<body>  
{% block content %}

		<br>

		<div class="row">
			<div class="col-md">
				<div class="card card-body">
					<table class="table">
						<tr>
							<th>Id</th>
							<th>OG URL</th>
							<th>Short URL</th>
						</tr>

						{% for i in short %}
							<tr>
								<td>{{i.id}}</td>
								<td>{{i.og_url}}</td>
								<td>{{i.short_url}}</td>
								
							</tr>
						{% endfor %}
						
					</table>
				</div>
			</div>
			
		</div>

{% endblock content %}	</body>  
</html>
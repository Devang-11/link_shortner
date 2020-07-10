<!DOCTYPE html>  
<html lang="en">  
<head>  
    <meta charset="UTF-8">  
    <title>index</title>  
    {% load static %}  
    <link href="{% static 'css/bootstrap.min.css' %}" rel="stylesheet">  
    <script src="{% static '/jquery-3.5.1.js' %}"></script>
    <script src="{% static 'js/bootstrap.min.js' %}"></script> 
    <script src="{% static '/particles.min.js' %}"></script><style>
      body, html {
  height: 100%;
}
#og_link {
    display: inline-block;
    width: 100%;
    white-space: nowrap;
    overflow: hidden !important;
    text-overflow: ellipsis;
}

.text {
    text-transform: uppercase;
    font-family: verdana;
    font-size: 5em;
    font-weight: 700;
    color: #f5f5f5;
    text-shadow: 1px 1px 1px #919191,
        1px 2px 1px #919191,
        1px 3px 1px #919191,
        1px 4px 1px #919191,
        1px 5px 1px #919191,
        1px 6px 1px #919191,
        1px 7px 1px #919191,
        1px 8px 1px #919191,
        1px 9px 1px #919191,
        1px 10px 1px #919191,
    1px 18px 6px rgba(16,16,16,0.4),
    1px 22px 10px rgba(16,16,16,0.2),
    1px 25px 35px rgba(16,16,16,0.2),
    1px 30px 60px rgba(16,16,16,0.4);
}
h5{
	color:blue;
	font-weight: bold;
	border-radius: 5px;
}
 canvas{ display: block; vertical-align: bottom; } /* ---- particles.js container ---- */ #particles-js{ z-index:0; position:absolute; width: 100%; height: 100%; background-color: blue; background-image: url(""); background-repeat: no-repeat; background-size: cover; background-position: 50% 50%; } /* ---- stats.js ---- */ .count-particles{ background: #000022; position: absolute; top: 48px; left: 0; width: 80px; color: #13E8E9; font-size: .8em; text-align: left; text-indent: 4px; line-height: 14px; padding-bottom: 2px; font-family: Helvetica, Arial, sans-serif; font-weight: bold; } .js-count-particles{ font-size: 1.1em; } #stats, .count-particles{ -webkit-user-select: none; margin-top: 5px; margin-left: 5px; } #stats{ border-radius: 3px 3px 0 0; overflow: hidden; } .count-particles{ border-radius: 0 0 3px 3px; }
@media only screen and (max-width: 768px) {
	.text{
		font-size: 3em;
	}
}
    </style>
</head>  
<body>
<div id="particles-js"></div>
    <div class="container-fluid h-100 px-3 py-3">
      <div class="row h-100 justify-content-center align-items-center">
 <form method="post" id="myform" class=" col-10 px-2 py-2">
<div class="text col-12 text-center mb-5">Short Url</div>
 {% csrf_token %}
  
  <div class="input-group form-group mb-0">
            <input type="text" class="form-control" placeholder="Paste URL Here..." name="og_url" id="og_url" required>
            <div class="input-group-append">
  <button type="submit" id="submit" class="btn btn-primary">Submit</button>  
            </div>
          </div>
            <p class="text-light">https://www.domain.com <-- link format</p>

<div class="container-fluid col-12 px-2 py-2">
  <div class="text-light post">
  </div>
</div>
</div>

</form>

</div>
<script>


    $(document).on('submit', '#myform',function(e){
      e.preventDefault();
      $.ajax({
          type:'POST',
          url:'{% url "create" %}',
          data:{
              og_url:$('#og_url').val(),
              csrfmiddlewaretoken:$('input[name=csrfmiddlewaretoken]').val(),
              action: 'post'
          },
          success:function(json){
              document.getElementById("myform").reset();
              $(".post").append('<div class="row my-1"><div class="col-md-4 bg-light"><h5 id="og_link">'+json.og_url+'</h5></div><div class="col-md-4 bg-light"><h5 id="select_txt">https://sh-link.herokuapp.com/'+json.short_url+'</h5></div><div class="col-md-4 my-1"><button type="button" class="btn btn-light btn-md-lg btn-block" onclick="copy_data(select_txt)">Copy</button></div></div>');
              
          },
          error : function(xhr,errmsg,err) {
            alert(errmsg);
          console.log(xhr.status + ": " + xhr.responseText); // provide a bit more info about the error to the console
      }
      });
    });
function copy_data(select_txt) {
  var range = document.createRange();
  const selectButton = document.getElementById('select_txt');
  range.selectNode(selectButton); //changed here
  window.getSelection().removeAllRanges(); 
  window.getSelection().addRange(range); 
  document.execCommand("copy");
  window.getSelection().removeAllRanges();
  alert("data copied");
}

  particlesJS("particles-js", {"particles":{"number":{"value":80,"density":{"enable":true,"value_area":800}},"color":{"value":"#ffffff"},"shape":{"type":"circle","stroke":{"width":0,"color":"#000000"},"polygon":{"nb_sides":5},"image":{"src":"img/github.svg","width":100,"height":100}},"opacity":{"value":0.5,"random":false,"anim":{"enable":false,"speed":1,"opacity_min":0.1,"sync":false}},"size":{"value":3,"random":true,"anim":{"enable":false,"speed":40,"size_min":0.1,"sync":false}},"line_linked":{"enable":true,"distance":150,"color":"#ffffff","opacity":0.4,"width":1},"move":{"enable":true,"speed":6,"direction":"none","random":false,"straight":false,"out_mode":"out","bounce":false,"attract":{"enable":false,"rotateX":600,"rotateY":1200}}},"interactivity":{"detect_on":"canvas","events":{"onhover":{"enable":false,"mode":"repulse"},"onclick":{"enable":false,"mode":"push"},"resize":true},"modes":{"grab":{"distance":400,"line_linked":{"opacity":1}},"bubble":{"distance":400,"size":40,"duration":2,"opacity":8,"speed":3},"repulse":{"distance":200,"duration":0.4},"push":{"particles_nb":4},"remove":{"particles_nb":2}}},"retina_detect":true});
</script>
</body>  
</html>
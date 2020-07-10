import datetime
import uuid
from django.shortcuts import redirect, get_object_or_404
from django.http import JsonResponse
from link_shortner import settings  
from django.shortcuts import render
from django.http import HttpResponse
from django.template import loader
from link_short.models import Short
# Create your views here.

def myform1(request):  
    return render(request,'index.php')

def savei(request):
    response_data = {}
    if request.method=="POST":
        og_url=request.POST['og_url']
        u = uuid.uuid4().hex[:6].upper()
        short_url= u
        print(og_url,short_url)
        ins=Short(og_url=og_url,short_url=short_url)
        ins.save()
        print("success")
        c = Short.objects.latest('id')
        response_data['short_url'] =  c.short_url
        response_data['og_url'] =  c.og_url
        return JsonResponse(response_data)

    return render(request,'index.php')

def Home(request,token):
    if token=='data':
        short = Short.objects.all()
        context = {'short':short}
        return render(request, 'data.php',context)
    else:
        og_url = Short.objects.filter(short_url=token)[0]
        return redirect(og_url.og_url)

from django.db import models
from django.utils import timezone

# Create your models here.
class Short(models.Model):
    short_url = models.CharField(max_length=100)
    og_url = models.CharField(max_length=100)
    date_created = models.DateTimeField(default=timezone.now)
    def __str__(self):
        return self.short_url

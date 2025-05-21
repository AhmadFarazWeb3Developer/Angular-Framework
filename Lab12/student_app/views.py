from django.shortcuts import render
from .studentModel import Student


def home(request):
    students = Student.objects.all()
    return render(request, 'student_app/home.html', {'students': students})

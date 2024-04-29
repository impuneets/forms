<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Session</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <h1 class="text-center">{{$title}}</h1>
    <div style="text-align: right; margin-right:10%">
        <a href="{{url('/')}}/athletes"><button class="btn btn-info">Show All</button></a>
    </div>
    <form action="{{$url}}" id="submitForm" method="post" enctype="multipart/form-data">
       @csrf
    <div class="container mt-5">
            <div class="form-group">
                <label for="title">Title:<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $athlete->title ?? '') }}" required>
                <span class="text-danger">
                    @error('title')
                        {{$message}}
                    @enderror
                </span>
            </div>
            <div class="form-group">
                <label for="date">Date:<span class="text-danger">*</span></label>
                <input type="date" class="form-control" id="date" name="date" value="{{ old('date', $athlete->date ?? '') }}" required>
                <span class="text-danger">
                    @error('date')
                    {{$message}}
                        
                    @enderror
                </span>
            </div>
            <div class="form-group">
                <label for="link">Link:<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="link" name="link" value="{{ old('link', $athlete->link ?? '') }}" required>
                <span class="text-danger">
                    @error('link')
                    {{$message}}
                        
                    @enderror
                </span>
            </div>
            <div class="form-group">
                <label for="register_image">Register Image:<span class="text-danger">*</span></label>
                <input type="file" class="form-control-file" id="register_image" name="register_image" {{$athlete->register_image!='' ? '' :'required'}}>
                @if ($athlete->register_image!='')
                
                <img src="{{asset('storage/uploads/'. $athlete->register_image)}}" width="80" height="80" alt="">
                @endif
                <span class="text-danger">
                    @error('register_image')
                    {{$message}}
                        
                    @enderror
                </span>
            </div>
            <div class="form-group">
                <label for="join_image">Join Image:<span class="text-danger">*</span></label>
                <input type="file" class="form-control-file" id="join_image" name="join_image" {{$athlete->join_image!='' ? '' :'required'}}>
                @if ($athlete->join_image!='')
                <img src="{{asset('storage/uploads/'. $athlete->join_image)}}" width="80" height="80" alt="">
                @endif

                <span class="text-danger">
                    @error('join_image')
                    {{$message}}
                        
                    @enderror
                </span>
            </div>
            <div class="form-group">
                <label for="level">Select Level:<span class="text-danger">*</span></label>
                <select class="form-control" id="level" name="level" required>
                    <option value="beginner" {{ (old('level', $athlete->level ?? '') == 'beginner') ? 'selected' : '' }}>Beginner</option>
                    <option value="intermediate" {{ (old('level', $athlete->level ?? '') == 'intermediate') ? 'selected' : '' }}>Intermediate</option>
                    <option value="advanced" {{ (old('level', $athlete->level ?? '') == 'advanced') ? 'selected' : '' }}>Advanced</option>
                </select>
                <span class="text-danger">
                    @error('level')
                    {{$message}}
                        
                    @enderror
                </span>
            </div>
            <div class="form-group">
                <label for="coach_name">Coach Name:<span class="text-danger">*</span></label>
                <select class="form-control" id="coach_name" name="coach_name" required>
                    <option value="coach1" {{ (old('coach_name', $athlete->coach_name ?? '') == 'coach1') ? 'selected' : '' }}>Coach 1</option>
                    <option value="coach2" {{ (old('coach_name', $athlete->coach_name ?? '') == 'coach2') ? 'selected' : '' }}>Coach 2</option>
                    <!-- Add more options as needed -->
                </select>
                <span class="text-danger">
                    @error('coach_name')
                    {{$message}}
                        
                    @enderror
                </span>
            </div>
            <div class="form-group">
                <label for="coach_description">Coach Description:<span class="text-danger">*</span></label>
                <textarea class="form-control" id="coach_description" name="coach_description" rows="3" required>{{ old('coach_description', $athlete->coach_description ?? '') }}</textarea>
                <span class="text-danger">
                    @error('coach_description')
                    {{$message}}
                        
                    @enderror
                </span>
            </div>
            <div class="form-group">
                <label for="coach_image">Coach Image:<span class="text-danger">*</span></label>
                <input type="file" class="form-control-file" id="coach_image" name="coach_image" {{$athlete->coach_image!='' ? '' :'required'}}>
                @if ($athlete->coach_image!='')
                <img src="{{asset('storage/uploads/'. $athlete->coach_image)}}" width="80" height="80" alt="">
                @endif

                <span class="text-danger">
                    @error('coach_image')
                    {{$message}}
                        
                    @enderror
                </span>
            </div>
            <div class="form-group">
                <label for="language">Select Language:<span class="text-danger">*</span></label>
                <select class="form-control" id="language" name="language" required>
                    <option value="english" {{ (old('language', $athlete->language ?? '') == 'english') ? 'selected' : '' }}>English</option>
                    <option value="hindi" {{ (old('language', $athlete->language ?? '') == 'hindi') ? 'selected' : '' }}>Hindi</option>
                </select>
                <span class="text-danger">
                    @error('language')
                    {{$message}}
                        
                    @enderror
                </span>
            </div>
            <div class="form-group">
                <label for="session_time">Session Time:<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="session_time" name="session_time" value="{{ old('session_time', $athlete->session_time ?? '') }}" required>
                <span class="text-danger">
                    @error('session_time')
                    {{$message}}
                        
                    @enderror
                </span>
            </div>
            <div class="form-group">
                <label for="session_label">Session Label:<span class="text-danger">*</span></label>
                <select class="form-control" id="session_label" name="session_label" required>
                    <option value="workshop" {{ (old('session_label', $athlete->session_label ?? '') == 'workshop') ? 'selected' : '' }}>Workshop</option>
                    <option value="training" {{ (old('session_label', $athlete->session_label ?? '') == 'training') ? 'selected' : '' }}>Training</option>
                    <!-- Add more options as needed -->
                </select>
                <span class="text-danger">
                    @error('session_label')
                    {{$message}}
                        
                    @enderror
                </span>
            </div>
            <div class="form-group">
                <label for="session_type">Session Type:<span class="text-danger">*</span></label>
                <select class="form-control" id="session_type" name="session_type" required>
                    <option value="live" {{ (old('session_type', $athlete->session_type ?? '') == 'live') ? 'selected' : '' }}>Live</option>
                    <option value="recorded" {{ (old('session_type', $athlete->session_type ?? '') == 'recorded') ? 'selected' : '' }}>Recorded</option>
                    <!-- Add more options as needed -->
                </select>
                <span class="text-danger">
                    @error('session_type')
                    {{$message}}
                        
                    @enderror
                </span>
            </div>
            <div class="form-group">
                <label for="description">Description:<span class="text-danger">*</span></label>
                <textarea class="form-control" id="description" name="description" rows="5" required>{{ old('description', $athlete->description ?? '') }}</textarea>
                <span class="text-danger">
                    @error('description')
                    {{$message}}
                        
                    @enderror
                </span>
            </div>
            <div class="form-group">
                <label for="dos_and_donts">Dos and Don'ts:</label>
                <textarea class="form-control" id="dos_and_donts" name="dos_and_donts" rows="3">{{ old('dos_and_donts', $athlete->dos_and_donts ?? '') }}</textarea>
                <span class="text-danger">
                    @error('dos_and_donts')
                    {{$message}}
                        
                    @enderror
                </span>
            </div>
            <div class="form-group">
                <label for="health_details">Health Details:</label>
                <textarea class="form-control" id="health_details" name="health_details" rows="3">{{ old('health_details', $athlete->health_details ?? '') }}</textarea>
                <span class="text-danger">
                    @error('health_details')
                    {{$message}}
                        
                    @enderror
                </span>
            </div>
            <div class="form-group">
                <label for="faqs">FAQs:</label>
                <textarea class="form-control" id="faqs" name="faqs" rows="3">{{ old('faqs', $athlete->faqs ?? '') }}</textarea>
                <span class="text-danger">
                    @error('faqs')
                    {{$message}}
                        
                    @enderror
                </span>
            </div>
            <button class="btn btn-primary">Submit</button>
        </div>
    </form> 
</body>
<script>
document.addEventListener("DOMContentLoaded", function() {
        let form = document.getElementById('submitForm');
        let fileInputs = document.querySelectorAll('input[type="file"]');
        fileInputs.forEach(function(input) {
            input.addEventListener('change', function() {
                // Get the selected file
                let file = this.files[0];

                // Validate the file
                let isValid = isValidFile(file);

                // Display error message if file is invalid
                if (!isValid) {
                    alert('Please select a valid image file (JPG, JPEG, or PNG) less than 5MB.');
                    // Clear the file input to allow the user to select a valid file
                    this.value = '';
                }
            });
        });

        form.addEventListener("submit", function(event) {
            // Prevent form submission
            event.preventDefault();

            // Perform validation
            let title = document.getElementById('title').value.trim();
            let date = document.getElementById('date').value.trim();
            let link = document.getElementById('link').value.trim();
            let time = document.getElementById('session_time').value.trim();
            // Validate other fields similarly...
            console.log(time);

            if (title === "") {
                alert("Title is required");
                return;
            }

            let titleRegex = /^[a-zA-Z0-9\s]+$/;
            if (!titleRegex.test(title)) {
                alert("Title can only contain letters, numbers, and spaces.");
                return;
            }

            if (date === "") {
                alert("Date is required");
                return;
            }
            
            let isValidDate = isValidDateFormat(date);
            if (!isValidDate) {
                alert("Invalid date format. Please use DD/MM/YYYY format.");
                return;
            }

            if (link === "") {
                alert("Link is required");
                return;
            }

            let isValidLink = isValidURL(link);
            if (!isValidLink) {
                alert("Invalid link format. Please enter a valid URL.");
                return;
            }

            let isValidateTime = isValidTimeFormat(time)
            if(!isValidateTime){
                alert('Invalid Time Format. Please use HH:MM format.')
                return
            }

            

            // Perform additional validations for other fields...

            // If all validations pass, submit the form
            form.submit();
        });
    });

    function isValidDateFormat(dateString) {
    // Check if the date string matches the dd/mm/yyyy format
    let dateRegex = /^\d{4}-\d{2}-\d{2}$/;
    return dateRegex.test(dateString);
    }

    function isValidURL(urlString) {
    // Regular expression for URL validation
    let urlRegex = /^(ftp|http|https):\/\/[^ "]+$/;
    return urlRegex.test(urlString);
    }

    function isValidFile(file) {
    // Check if the file type is one of jpg, jpeg, or png
    let allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
    if (!allowedTypes.includes(file.type)) {
        return false; // Invalid file type
    }

    // Check if the file size is less than 5MB
    let maxSize = 5 * 1024 * 1024; // 5MB in bytes
    if (file.size > maxSize) {
        return false; // File size exceeds 5MB
    }

    return true; // File is valid
}

function isValidTimeFormat(timeString) {
    // Check if the time string matches the HH:MM format
    let timeRegex = /^([01]?[0-9]|2[0-3]):[0-5][0-9]$/;
    return timeRegex.test(timeString);
}
</script>
</html>


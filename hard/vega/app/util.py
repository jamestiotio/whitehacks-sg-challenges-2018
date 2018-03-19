def get_file_extension(file_name):
    dot_index = file_name.find('.')
    if dot_index != -1:
        return file_name[dot_index + 1:]
    return ''

def is_image_file(file_name):
    extension = get_file_extension(file_name).lower()
    return extension in ('jpg', 'jpeg', 'png')

def get_matching_files(filename_list, keyword):
    for filename in filename_list:
        if keyword in filename:
            yield filename

import os
from PIL import Image

import util

def get_all_image_details_in_dir(img_dir):
    file_names_list = os.listdir(img_dir)

    for file_name in file_names_list:
        # Only those files that are image files are considered.
        if(util.is_image_file(file_name)):
            file_full_path = os.path.join(img_dir, file_name)
            with Image.open(file_full_path) as img:
                yield (file_name, img.size)

def get_matching_image_details(img_dir, keyword):
    file_names_list = os.listdir(img_dir)
    matching_file_names_list = util.get_matching_files(file_names_list, keyword)
    
    for file_name in matching_file_names_list:
        if(util.is_image_file(file_name)):
            file_full_path = os.path.join(img_dir, file_name)
            with Image.open(file_full_path) as img:
                yield (file_name, img.size)
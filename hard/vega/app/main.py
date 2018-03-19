from flask import Flask, render_template, request, redirect, url_for
from jinja2 import Template
from werkzeug.utils import secure_filename

import os
import model, util

app = Flask(__name__)

# directories which store image files
image_dir = "./static/images/"
ALLOWED_EXTENSIONS = set(['jpg', 'jpeg', 'png'])
app.config['UPLOAD_FOLDER'] = image_dir

@app.route("/")
def root():
    return render_template("root.html", 
        image_details = model.get_all_image_details_in_dir(image_dir))

@app.route("/search", methods=["POST", "GET"])
def search():
    if request.method == "POST":
        keyword = request.form["keyword"]
        body = render_template("root.html", 
            image_details = model.get_matching_image_details(image_dir, keyword), 
            is_post = True)
        t = Template(body.replace('@keyword@', keyword))
        return t.render()
    else:
        return render_template("search.html")

@app.route('/upload', methods=['GET', 'POST'])
def upload_file():
    if request.method == 'POST':
        # check if the post request has the file part
        if 'file' not in request.files:
            flash('No file part')
            return redirect(request.url)
        file = request.files['file']
        # if user does not select file, browser also
        # submit a empty part without filename
        if file.filename == '':
            flash('No selected file')
            return redirect(request.url)
        if file and util.is_image_file(file.filename):
            filename = secure_filename(file.filename)
            file.save(os.path.join(app.config['UPLOAD_FOLDER'], filename))
            return redirect(url_for('upload_file', filename=filename))
    return render_template('upload.html')
        
if __name__ == "__main__":
    app.run(port=8000, host='0.0.0.0')
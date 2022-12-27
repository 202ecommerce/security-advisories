How to install project localy ?

 - **Install ruby :**
    sudo apt-get install ruby-full

 - 
    gem install jekyll bundler

 - **Install and update the dependencies specified in your Gemfile :**
    bundle install
    bundle update github-pages

 - **Runs the exact jekyll server version that is specified in your Gemfile.lock :**
    bundle exec jekyll serve
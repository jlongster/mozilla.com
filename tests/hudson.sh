# This script should be called from within Hudson

cd $WORKSPACE
VENV=$WORKSPACE/venv

echo "Starting build..."

# Make sure there's no old pyc files around.
find . -name '*.pyc' | xargs rm

if [ ! -d "$VENV/bin" ]; then
  echo "No virtualenv found.  Making one..."
  virtualenv -p python2.6 --no-site-packages $VENV
fi

source $VENV/bin/activate
easy_install pip

pip install -q -r tests/requirements.txt

cd tests
cp settings.hudson settings.py

echo "Starting tests..."
find . -name 'test*.py' | grep -v venv | xargs nosetests --with-xunit

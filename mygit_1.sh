git remote set-url origin https://github.com/HCarlos/SiacGob.git
git config --global user.name "HCarlos"
git config --global color.ui true
git config core.fileMode false
git config --global push.default simple

git checkout master

git status

# git add src/
git add .

git commit -m "SiacGob Init - 01"

git push -u origin master

exit

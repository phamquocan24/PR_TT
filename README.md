fnm env --use-on-cd | Out-String | Invoke-Expression
 
npm i
 
npm run devBuild
 
 
rm -r .\node_modules\
 
rm -r .\vendor\  
 
composer i
 
php artisan optimize:clear
https://drive.google.com/drive/u/0/folders/19czF9ak7tIMye3znTnn9KfM7HDb3IZCy
# Ecommerce

## Cơ sở dữ liệu
![ecommerce.png](public/ecommerce.png)

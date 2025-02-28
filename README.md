# Steps taken to obtain this setup:

# Create new Laravel project:
```
laravel new investments-tracker
cd investments-tracker
```

# Install and start DDEV:
```
ddev config
ddev start
```

# Run the npm build steps:
```
ddev npm install
ddev npm run build
```

# Commit and push to GitHub first version:

``` 
git init
git add .
git commit -m "Install Laravel + DDEV"
git remote add origin git@github.com:carpatin/investments-tracker.git
git push -u origin main
```

# Run migrations
```
ddev artisan migrate
```

...

Goto: https://investments-tracker.ddev.site

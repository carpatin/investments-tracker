# Clone the repository

`git clone git@github.com:carpatin/investments-tracker.git`

# Change the current directory to the project's directory

`cd investments-tracker/`

# Install and start DDEV:

```
ddev start
```

# Install the project's dependencies

`ddev composer install -n`

# Setup the environment variables (change the default values if needed)

```
cp .env.example .env
cp .env.testing.example .env.testing
```

# Generate the application's key

`ddev artisan key:generate`
`ddev artisan key:generate --env=testing`

# Run the npm build steps:
```
ddev npm install
ddev npm run build
```

# Run migrations
```
ddev artisan migrate
```

# Seed the database
```
ddev artisan db:seed
```

# Check the available functionality

### Obtain API Bearer token from:

POST [https://investments-tracker.ddev.site/api/login](https://investments-tracker.ddev.site/api/login)

By sending a body like:
```
{
  "email" : "address@example.org",
  "password": "password"
}

```

### Access the GraphQL endpoint at:

POST [https://investments-tracker.ddev.site/graphql](https://investments-tracker.ddev.site/graphql)

### Access the GraphiQL dashboard at:

[https://investments-tracker.ddev.site/graphiql](https://investments-tracker.ddev.site/graphiql)

### Access the web application at:

[https://investments-tracker.ddev.site](https://investments-tracker.ddev.site)

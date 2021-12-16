# String Calculator

This is a string calculator CLI app.

## Installation

1 - Clone the repository.
```bash
git clone git@github.com:fbsouzas/string-calculator.git
```

2 - Go to the app directory.
```bash
cd string-calculator
```

3 - Create the Docker image and initiate the container.
```bash
docker-compose up --build -d
```

4 - Install the app dependencies.
```bash
docker-compose exec string-calculator-app composer install
```
## How to calculate a string

Run in your terminal
```bash
docker-compose exec string-calculator-app php cli app:calculate-string {numbers}
```

For example:
```bash
docker-compose exec string-calculator-app php cli app:calculate-string "1,2,3"

Output:
The result is: 6
```

## Run tests
```bash
docker-compose exec string-calculator-app composer test
```

## Author
[Fábio Souza](https://github.com/fbsouzas)

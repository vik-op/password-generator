# Password Generator (OOP & MVC)

Test assignment: Password Generator built with PHP 8.

## Key Features (Implemented)
- **Character Uniqueness:** Characters do not repeat within a single password.
- **Password Uniqueness:** The system checks history and ensures the same password is never generated twice.
- **Mandatory Character Sets:** If multiple sets are selected, the password is guaranteed to contain at least one character from each.
- **Exclusions:** Visually similar characters (0, 1, O, o, l) are excluded from the sets to improve readability.

## Project Structure
- `public/` — Entry points (`index.php`, `api.php`) and client-side logic.
- `src/` — Business logic (Core, Controllers, Services, Interfaces).
- `views/` — HTML templates.
- `data/` — Password history storage.

## Installation and Setup

The application requires **PHP 8.1+** and **Composer**.

### 1. Clone the repository
```bash
git clone https://github.com/vik-op/password-generator.git
```
```bash
cd password-generator
```

### 2. Install dependencies (Autoloader)
```bash
composer install
```

### 3. Run the local server
```bash
php -S localhost:8000 -t public
```

### Usage

Open `http://localhost:8000` in your browser.

Note: The `data/` folder and the history file will be created automatically upon the first password generation.

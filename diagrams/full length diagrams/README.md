# UML Diagrams for Small Shopping Site Laravel

This directory contains UML diagrams for the Small Shopping Site Laravel project.

## Diagrams Included

1. **Use Case Diagram** (`usecase_diagram.puml`)
   - Shows all use cases for Admin, User, and Guest actors
   - Includes relationships (include, extend) between use cases

2. **Class Diagram** (`class_diagram.puml`)
   - Shows all models (User, Product, Category, Order, Cart, Wishlist, State, City)
   - Displays attributes and methods
   - Shows relationships between classes

3. **Interaction/Sequence Diagram** (`interaction_diagram.puml`)
   - Shows the order placement flow
   - Illustrates interactions between controllers, models, and services
   - Includes payment processing flow

4. **Admin Interaction Diagram** (`admin_interaction_diagram.puml`)
   - Shows admin workflows for product and category management
   - Illustrates order and customer management flows
   - Includes Excel import/export operations

5. **Activity Diagram** (`activity_diagram.puml`)
   - Shows the complete shopping cart and checkout process
   - Includes decision points and parallel activities
   - Covers product browsing, cart management, and order placement

## How to View These Diagrams

### Option 1: PlantUML Online
1. Visit http://www.plantuml.com/plantuml/uml/
2. Copy and paste the content of any `.puml` file
3. The diagram will be rendered automatically

### Option 2: VS Code Extension
1. Install the "PlantUML" extension in VS Code
2. Open any `.puml` file
3. Press `Alt+D` to preview the diagram

### Option 3: PlantUML Command Line
```bash
# Install PlantUML (requires Java)
# Download from: http://plantuml.com/download

# Generate PNG
java -jar plantuml.jar usecase_diagram.puml

# Generate SVG
java -jar plantuml.jar -tsvg usecase_diagram.puml
```

### Option 4: Online Tools
- http://www.plantuml.com/plantuml/uml/
- https://www.planttext.com/
- https://kroki.io/

## Project Overview

This is a Laravel-based e-commerce application with the following main features:

### Admin Features
- Dashboard with statistics
- Product management (CRUD)
- Category management (CRUD)
- Order management
- Customer management
- Reports generation
- Excel import/export

### User Features
- User registration and authentication
- Email verification
- Product browsing and search
- Shopping cart management
- Wishlist functionality
- Order placement
- Payment processing (Stripe)
- Order history and PDF download
- Profile management

### Models
- **User**: Admin and regular users
- **Product**: Products with categories, pricing, and stock
- **Category**: Product categories
- **Order**: User orders with invoice numbers
- **Cart**: Shopping cart items
- **Wishlist**: User wishlist items
- **State/City**: Address management

## Notes

- All diagrams use PlantUML syntax
- Diagrams can be customized by editing the `.puml` files
- The diagrams reflect the current state of the codebase
- Relationships and flows are based on the actual implementation


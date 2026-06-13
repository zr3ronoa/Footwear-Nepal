#ifndef MODELS_H
#define MODELS_H

// =============================================================
//  models.h  —  Shared data structures
//
//  This file is the "contract" between your frontend and the
//  backend branches. Everyone includes this file and agrees on
//  what an Order / MenuItem looks like.
//
//  No Qt widgets here — just plain data.
// =============================================================

#include <QString>
#include <QVector>
#include <QDateTime>

// -------------------------------------------------------------
//  MenuItem  —  one item that appears on the menu
// -------------------------------------------------------------
struct MenuItem {
    int     id;
    QString name;
    QString category;       // e.g. "Burgers", "Pizza", "Drinks"
    double  price;          // in dollars
    int     prepTimeMins;   // how many minutes the kitchen needs
    int     stock;          // units currently available
};

// -------------------------------------------------------------
//  OrderItem  —  a menu item chosen inside an order
//  e.g.  { Margherita Pizza, quantity=2 }
// -------------------------------------------------------------
struct OrderItem {
    MenuItem item;
    int      quantity;
};

// -------------------------------------------------------------
//  OrderStatus  —  lifecycle of a single order
// -------------------------------------------------------------
enum class OrderStatus {
    Pending,          // just placed, kitchen hasn't started yet
    Preparing,        // kitchen is cooking
    Ready,            // food is packed, waiting for rider
    OutForDelivery,   // rider has picked up
    Delivered         // customer received it
};

// -------------------------------------------------------------
//  Order  —  one customer order
// -------------------------------------------------------------
struct Order {
    int                id;
    QString            customerName;
    QString            customerAddress;
    QString            customerPhone;
    QVector<OrderItem> items;
    OrderStatus        status;
    QDateTime          placedAt;
    int                estimatedPrepMins;      // longest item prep time
    int                estimatedDeliveryMins;  // fixed rider estimate (e.g. 30)
    double             totalPrice;
};

#endif // MODELS_H

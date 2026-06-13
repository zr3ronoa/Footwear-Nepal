#ifndef MAINWINDOW_H
#define MAINWINDOW_H

// =============================================================
//  mainwindow.h  —  YOUR file as frontend developer
//
//  This is the entire app shell. It owns:
//    • A dark top navigation bar (logo, search, nav links)
//    • A hero banner with the kitchen name
//    • A scrollable food-card grid (Latest Food Items)
//
//  The other pages (orders, menu, delivery, reports) are stub
//  placeholders owned by other branches — you don't touch them.
// =============================================================

#include <QMainWindow>
#include <QWidget>
#include <QLabel>
#include <QLineEdit>
#include <QPushButton>
#include <QScrollArea>
#include <QVBoxLayout>
#include <QHBoxLayout>
#include <QGridLayout>
#include <QVector>
#include <QPixmap>
#include "models.h"

class MainWindow : public QMainWindow
{
    Q_OBJECT

public:
    explicit MainWindow(QWidget *parent = nullptr);
    ~MainWindow();

private:
    void buildWindow();       // assembles all sections
    void buildNavBar();       // dark top bar
    void buildHero();         // full-width banner
    void buildFoodGrid();     // "Food Items" card grid
    void buildFooter();       // bottom copyright bar
    void applyTheme();        // global QSS stylesheet

    // The card builder — returns one food item widget
    QWidget* makeFoodCard(const MenuItem &item);

    // ── UI regions ──
    QWidget    *navBar;
    QWidget    *heroSection;
    QWidget    *gridSection;
    QWidget    *footerBar;
    QScrollArea *scrollArea;

    // Sample menu data seeded locally (other branches own the real DB)
    QVector<MenuItem> menuItems;
    void seedMenuItems();
};

#endif // MAINWINDOW_H

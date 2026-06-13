// =============================================================
//  mainwindow.cpp  —  YOUR file as frontend developer
//
//  Builds the Chuwassa UI:
//    1. Dark navbar  (logo | search | About Cart Sign In)
//    2. Hero banner  (big kitchen image + title overlay)
//    3. Food card    (single Burger item with Add to Cart)
//    4. Footer       (copyright bar)
// =============================================================

#include "mainwindow.h"
#include <QApplication>
#include <QFrame>
#include <QPixmap>
#include <QPainter>
#include <QLinearGradient>
#include <QPainterPath>
#include <QGraphicsDropShadowEffect>
#include <QFont>
#include <QSizePolicy>

// ── Constructor ───────────────────────────────────────────────
MainWindow::MainWindow(QWidget *parent)
    : QMainWindow(parent)
{
    setWindowTitle("Chuwassa");
    setMinimumSize(900, 700);
    resize(1200, 820);

    applyTheme();
    seedMenuItems();
    buildWindow();
}

MainWindow::~MainWindow() {}

// ── Global QSS stylesheet ─────────────────────────────────────
void MainWindow::applyTheme()
{
    qApp->setStyleSheet(R"(

        /* Base */
        QMainWindow, QWidget {
            background-color: #ffffff;
            color: #222222;
            font-family: 'Segoe UI', Arial, sans-serif;
            font-size: 13px;
        }

        /* ── Navbar ── */
        QWidget#navBar {
            background-color: #2b2b2b;
        }
        QLabel#navLogo {
            color: #ffffff;
            font-size: 15px;
            font-weight: bold;
            letter-spacing: 1px;
            background: transparent;
        }
        QLabel#navLogoIcon {
            background-color: #3c3c3c;
            color: #888888;
            font-size: 9px;
            border: 1px dashed #666666;
        }
        QLineEdit#searchBox {
            background-color: #ffffff;
            border: none;
            border-radius: 0px;
            padding: 6px 10px;
            font-size: 12px;
            color: #444;
            min-width: 200px;
        }
        QPushButton#searchBtn {
            background-color: #4caf50;
            color: #ffffff;
            border: none;
            border-radius: 0px;
            padding: 7px 14px;
            font-size: 12px;
            font-weight: bold;
            letter-spacing: 0.5px;
        }
        QPushButton#searchBtn:hover { background-color: #43a047; }

        QPushButton#navLink {
            background: transparent;
            color: #cccccc;
            border: none;
            font-size: 11px;
            font-weight: bold;
            letter-spacing: 0.8px;
            padding: 6px 10px;
        }
        QPushButton#navLink:hover { color: #ffffff; }

        /* ── Footer ── */
        QWidget#footerBar {
            background-color: #2b2b2b;
        }
        QLabel#footerText {
            color: #aaaaaa;
            font-size: 11px;
            background: transparent;
        }

        /* ── Hero ── */
        QWidget#heroWidget {
            background-color: #1a1a1a;
        }
        QLabel#heroTitle {
            color: #ffffff;
            font-size: 36px;
            font-weight: bold;
            letter-spacing: 3px;
            border: 3px solid #ffffff;
            padding: 10px 28px;
            background: transparent;
        }

        /* ── Section heading ── */
        QLabel#sectionTitle {
            color: #222222;
            font-size: 15px;
            font-weight: bold;
            letter-spacing: 0.5px;
        }

        /* ── Food card ── */
        QWidget#foodCard {
            background-color: #ffffff;
            border: 1px solid #e0e0e0;
        }
        QWidget#foodCard:hover {
            border: 1px solid #aaaaaa;
        }
        QLabel#cardTitle {
            color: #222222;
            font-size: 12px;
            font-weight: bold;
        }
        QLabel#cardReviews {
            color: #999999;
            font-size: 11px;
        }
        QLabel#cardPrice {
            color: #222222;
            font-size: 14px;
            font-weight: bold;
        }
        QPushButton#addToCartBtn {
            background-color: #4caf50;
            color: #ffffff;
            border: none;
            border-radius: 0px;
            padding: 8px 0px;
            font-size: 12px;
            font-weight: bold;
            letter-spacing: 0.5px;
        }
        QPushButton#addToCartBtn:hover { background-color: #43a047; }

        /* ── Scroll area ── */
        QScrollArea {
            border: none;
            background: #f5f5f5;
        }
        QScrollBar:vertical {
            background: #eeeeee;
            width: 8px;
        }
        QScrollBar::handle:vertical {
            background: #bbbbbb;
            border-radius: 4px;
        }
        QScrollBar::add-line:vertical,
        QScrollBar::sub-line:vertical { height: 0; }

    )");
}

// ── Seed demo menu items ───────────────────────────────────────
void MainWindow::seedMenuItems()
{
    // id  name                              category   price  prep stock
    menuItems = {
        {1, "Patty Melt Cheeseburger with potato fries","Burgers",13.99,15,18},
    };
}

// ── Build the full window ─────────────────────────────────────
void MainWindow::buildWindow()
{
    // Central widget holds everything in a vertical stack
    QWidget *central = new QWidget(this);
    setCentralWidget(central);

    QVBoxLayout *rootLayout = new QVBoxLayout(central);
    rootLayout->setSpacing(0);
    rootLayout->setContentsMargins(0,0,0,0);

    buildNavBar();
    buildHero();

    // Wrap the grid in a scroll area so it scrolls when items overflow
    scrollArea = new QScrollArea();
    scrollArea->setWidgetResizable(true);
    scrollArea->setFrameShape(QFrame::NoFrame);

    QWidget *scrollContent = new QWidget();
    scrollContent->setStyleSheet("background:#f5f5f5;");
    QVBoxLayout *scrollLayout = new QVBoxLayout(scrollContent);
    scrollLayout->setContentsMargins(0,0,0,24);
    scrollLayout->setSpacing(0);

    buildFoodGrid();
    scrollLayout->addWidget(gridSection);

    scrollArea->setWidget(scrollContent);

    buildFooter();

    rootLayout->addWidget(navBar);
    rootLayout->addWidget(heroSection);
    rootLayout->addWidget(scrollArea, 1);   // stretch=1 fills remaining height
    rootLayout->addWidget(footerBar);
}

// ── 1. Dark navigation bar ────────────────────────────────────
void MainWindow::buildNavBar()
{
    navBar = new QWidget();
    navBar->setObjectName("navBar");
    navBar->setFixedHeight(52);

    QHBoxLayout *lay = new QHBoxLayout(navBar);
    lay->setContentsMargins(24, 0, 24, 0);
    lay->setSpacing(10);

    // Logo image slot — put your logo at images/logo.png
    // (added to resources.qrc under /images/logo.png)
    QLabel *logoIcon = new QLabel();
    logoIcon->setObjectName("navLogoIcon");
    logoIcon->setFixedSize(36, 36);
    logoIcon->setAlignment(Qt::AlignCenter);
    logoIcon->setScaledContents(true);

    QPixmap logoPix(":/images/images/logo.png");
    if (!logoPix.isNull()) {
        logoIcon->setPixmap(logoPix.scaled(36, 36, Qt::KeepAspectRatio, Qt::SmoothTransformation));
        logoIcon->setStyleSheet("border:none; background:transparent;");
    } else {
        logoIcon->setScaledContents(false);
        logoIcon->setText("LOGO");
    }
    lay->addWidget(logoIcon);

    // Logo text (matching the screenshot)
    QLabel *logo = new QLabel("CHUWASSA");
    logo->setObjectName("navLogo");
    lay->addWidget(logo);

    lay->addSpacing(16);

    // Search box + button (inline, no border between them)
    QLineEdit *search = new QLineEdit();
    search->setObjectName("searchBox");
    search->setPlaceholderText("Search Food Items...");

    QPushButton *searchBtn = new QPushButton("SEARCH");
    searchBtn->setObjectName("searchBtn");

    lay->addWidget(search);
    lay->addWidget(searchBtn);

    lay->addStretch();  // pushes nav links to the right

    // Right-side nav links
    for (const QString &link : {"ABOUT", "CART", "SIGN IN"}) {
        QPushButton *btn = new QPushButton(link);
        btn->setObjectName("navLink");
        lay->addWidget(btn);
    }
}

// ── 2. Hero banner ────────────────────────────────────────────
void MainWindow::buildHero()
{
    // The hero is a fixed-height panel with a dark overlay and centered title.
    // In a real project you'd load an actual photo here with QPixmap.
    // We use a dark gradient to mimic the photo-with-overlay look.

    heroSection = new QWidget();
    heroSection->setObjectName("heroWidget");
    heroSection->setFixedHeight(320);

    // Paint a gradient that mimics a dark food photo
    heroSection->setStyleSheet(R"(
        QWidget#heroWidget {
            background: qlineargradient(
                x1:0, y1:0, x2:1, y2:1,
                stop:0 #1a1a2e,
                stop:0.4 #2d2d2d,
                stop:1 #0d0d0d
            );
        }
    )");

    // Center the title overlay
    QVBoxLayout *heroLayout = new QVBoxLayout(heroSection);
    heroLayout->setAlignment(Qt::AlignCenter);

    QLabel *heroTitle = new QLabel("CHUWASSA");
    heroTitle->setObjectName("heroTitle");
    heroTitle->setAlignment(Qt::AlignCenter);

    // Drop shadow on the title text for depth
    QGraphicsDropShadowEffect *shadow = new QGraphicsDropShadowEffect();
    shadow->setBlurRadius(20);
    shadow->setColor(QColor(0,0,0,180));
    shadow->setOffset(0, 4);
    heroTitle->setGraphicsEffect(shadow);

    heroLayout->addWidget(heroTitle, 0, Qt::AlignCenter);
}

// ── 3. Food card grid ─────────────────────────────────────────
void MainWindow::buildFoodGrid()
{
    gridSection = new QWidget();
    gridSection->setStyleSheet("background:#f5f5f5;");

    QVBoxLayout *outerLayout = new QVBoxLayout(gridSection);
    outerLayout->setContentsMargins(24, 24, 24, 8);
    outerLayout->setSpacing(16);

    // Section heading
    QLabel *heading = new QLabel("FOOD ITEMS");
    heading->setObjectName("sectionTitle");
    outerLayout->addWidget(heading);

    // 4-column grid layout
    QGridLayout *grid = new QGridLayout();
    grid->setSpacing(16);

    int col = 0, row = 0;
    const int COLS = 4;  // cards per row

    for (const auto &item : menuItems) {
        grid->addWidget(makeFoodCard(item), row, col);
        col++;
        if (col >= COLS) { col = 0; row++; }
    }

    outerLayout->addLayout(grid);
    outerLayout->addStretch();
}

// ── Helper: build one food card ───────────────────────────────
QWidget* MainWindow::makeFoodCard(const MenuItem &item)
{
    // Each card is a white bordered box with:
    //   [image placeholder]
    //   item name
    //   "0 reviews"
    //   $price

    QWidget *card = new QWidget();
    card->setObjectName("foodCard");
    card->setFixedWidth(210);
    card->setCursor(Qt::PointingHandCursor);

    QVBoxLayout *lay = new QVBoxLayout(card);
    lay->setContentsMargins(0, 0, 0, 0);
    lay->setSpacing(0);

    // ── Image ──
    // Loads your burger photo from the Qt resource file.
    // Put your image at ck2/images/burger.jpg and add it to
    // resources.qrc (see resources.qrc / CloudKitchen.pro).
    QLabel *imgLabel = new QLabel();
    imgLabel->setFixedSize(210, 140);
    imgLabel->setAlignment(Qt::AlignCenter);
    imgLabel->setScaledContents(true);

    QPixmap pix(":/images/images/burger.jpg");
    if (!pix.isNull()) {
        imgLabel->setPixmap(pix.scaled(210, 140, Qt::KeepAspectRatioByExpanding, Qt::SmoothTransformation));
    } else {
        // Fallback shown until you add your image
        imgLabel->setScaledContents(false);
        imgLabel->setStyleSheet("background-color:#eeeeee; color:#999999;");
        imgLabel->setText("Add image:\nimages/burger.jpg");
    }

    lay->addWidget(imgLabel);

    // ── Text section ──
    QWidget *textArea = new QWidget();
    textArea->setStyleSheet("background:white;");
    QVBoxLayout *textLay = new QVBoxLayout(textArea);
    textLay->setContentsMargins(10, 8, 10, 10);
    textLay->setSpacing(4);

    QLabel *nameLabel = new QLabel(item.name);
    nameLabel->setObjectName("cardTitle");
    nameLabel->setWordWrap(true);

    QLabel *reviewLabel = new QLabel("0 reviews");
    reviewLabel->setObjectName("cardReviews");

    QLabel *priceLabel = new QLabel(QString("$%1").arg(item.price, 0, 'f', 2));
    priceLabel->setObjectName("cardPrice");

    textLay->addWidget(nameLabel);
    textLay->addWidget(reviewLabel);
    textLay->addWidget(priceLabel);

    QPushButton *addBtn = new QPushButton("ADD TO CART");
    addBtn->setObjectName("addToCartBtn");
    addBtn->setStyleSheet("background-color:green; color: white; font-size: 10px; min-height: 20px;");
    addBtn->setCursor(Qt::PointingHandCursor);
    addBtn->setMinimumHeight(32);
    textLay->addSpacing(4);
    textLay->addWidget(addBtn);

    lay->addWidget(textArea);

    return card;
}

// ── 4. Footer with copyright ──────────────────────────────────
void MainWindow::buildFooter()
{
    footerBar = new QWidget();
    footerBar->setObjectName("footerBar");
    footerBar->setFixedHeight(40);

    QHBoxLayout *lay = new QHBoxLayout(footerBar);
    lay->setContentsMargins(24, 0, 24, 0);

    QLabel *copyright = new QLabel("© 2026 Chuwassa. All rights reserved.");
    copyright->setObjectName("footerText");

    lay->addStretch();
    lay->addWidget(copyright);
    lay->addStretch();
}

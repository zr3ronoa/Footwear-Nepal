// =============================================================
//  main.cpp  —  Application entry point
//
//  Every Qt program starts here. We create a QApplication
//  (which manages the event loop and global settings),
//  then show the MainWindow, then hand control to Qt.
// =============================================================

#include <QApplication>
#include "mainwindow.h"

int main(int argc, char *argv[])
{
    // QApplication MUST be created before any widgets.
    // argc/argv lets Qt parse command-line flags (e.g. -style).
    QApplication app(argc, argv);

    app.setApplicationName("Chuwassa");
    app.setOrganizationName("GroupProject");

    MainWindow window;
    window.show();          // show() makes the window visible

    return app.exec();      // exec() starts the event loop — app runs until window closes
}

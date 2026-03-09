
KTUtil.onDOMContentLoaded((function ()
{
    var mode = localStorage.getItem("theme_mode") ?? $(this).attr('data-mode');

    KTApp.setThemeMode(mode);
    $(document).on('click', '#theme_mode_btn', function ()
    {
        mode = localStorage.getItem("theme_mode");

        if (mode === 'dark')
        {
            $(this).attr('data-mode', 'light');

            KTApp.setThemeMode("light", function ()
            {
                localStorage.setItem("theme_mode", "light");
            }); // set light mode
        }
        else
        {
            $(this).attr('data-mode', 'dark');
            KTApp.setThemeMode("dark", function ()
            {
                localStorage.setItem("theme_mode", "dark");
            }); // set dark mode

        }

    });
}));

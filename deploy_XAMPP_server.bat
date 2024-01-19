rem cl parameter - url to open
rem global:
set s_xampp_web_root=\\10.15.131.218\htdocs
call build_web_root.bat
if not exist "%s_xampp_web_root%\validator" mkdir "%s_xampp_web_root%\validator"
call deploy_task_XAMPP.bat
rem deploy web root:
xcopy /s /i /y "web_root\*" "%s_xampp_web_root%\validator"

rem use LiveReload:
start "" https://dev-validator.ztu.edu.ua
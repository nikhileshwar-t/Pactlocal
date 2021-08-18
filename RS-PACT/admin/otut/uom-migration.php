<?php

$server = HTTP_SERVER;

?>
<style>
    .btn:hover a{
    color: white;
    }
    .btn-outline-info{
        /* padding: 12px 22px; */

        border: 2px solid #0099cc;
    }
    a:link {
    color: black;
    }

    a:visited {
    color: black;
    }

</style>

<section class="offering" id="offering">
<br>
    <div class="container">

        <div class="row">
                <h3 class="offset-4">UoM Migration Tool Guidelines</h3>
        </div>

        <br><br>

        <div class="row">
                <ul>
                    <li>UoM migration tool will be useful to migrate the existing UoM attributes data per the UoM attribute standards.</li>
                    <li>Migrations Supported : </li>
                    <ul>
                    <li>
                        <p>Simple attribute to simple UoM attribute migration</p>
                    </li>
                    <li>
                        <p>Nested attribute to nested UoM attribute migration</p>
                    </li>
                    <li>
                        <p>Nested attribute to simple UoM attribute migration</p>
                    </li>
                    </ul>
                    <li>Multi-valued attributes to multi-valued UoM attribute migration currently are not supported</li>
                    <li>"Configuration.json" is the file which takes the input for the tool.</li>
                </ul>
        </div>

        <br>

        <div class="row">
                <h5 class="offset-1"> <u>Useful Links</u> : </h5>
        </div>

        <div class="row">
                <ul class="offset-1">
                    <li>
                        <strong>
                            <a href="https://github.com/riversandtechnologies/RS-Pact/tree/dev/Pact-Tools/UOMMigration" target="_blank">GitHub 
                                <svg aria-hidden="true" width="20px" height="20px" focusable="false" data-prefix="fab" data-icon="github" class="svg-inline--fa fa-github fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" ><path fill="currentColor" d="M165.9 397.4c0 2-2.3 3.6-5.2 3.6-3.3.3-5.6-1.3-5.6-3.6 0-2 2.3-3.6 5.2-3.6 3-.3 5.6 1.3 5.6 3.6zm-31.1-4.5c-.7 2 1.3 4.3 4.3 4.9 2.6 1 5.6 0 6.2-2s-1.3-4.3-4.3-5.2c-2.6-.7-5.5.3-6.2 2.3zm44.2-1.7c-2.9.7-4.9 2.6-4.6 4.9.3 2 2.9 3.3 5.9 2.6 2.9-.7 4.9-2.6 4.6-4.6-.3-1.9-3-3.2-5.9-2.9zM244.8 8C106.1 8 0 113.3 0 252c0 110.9 69.8 205.8 169.5 239.2 12.8 2.3 17.3-5.6 17.3-12.1 0-6.2-.3-40.4-.3-61.4 0 0-70 15-84.7-29.8 0 0-11.4-29.1-27.8-36.6 0 0-22.9-15.7 1.6-15.4 0 0 24.9 2 38.6 25.8 21.9 38.6 58.6 27.5 72.9 20.9 2.3-16 8.8-27.1 16-33.7-55.9-6.2-112.3-14.3-112.3-110.5 0-27.5 7.6-41.3 23.6-58.9-2.6-6.5-11.1-33.3 2.6-67.9 20.9-6.5 69 27 69 27 20-5.6 41.5-8.5 62.8-8.5s42.8 2.9 62.8 8.5c0 0 48.1-33.6 69-27 13.7 34.7 5.2 61.4 2.6 67.9 16 17.7 25.8 31.5 25.8 58.9 0 96.5-58.9 104.2-114.8 110.5 9.2 7.9 17 22.9 17 46.4 0 33.7-.3 75.4-.3 83.6 0 6.5 4.6 14.4 17.3 12.1C428.2 457.8 496 362.9 496 252 496 113.3 383.5 8 244.8 8zM97.2 352.9c-1.3 1-1 3.3.7 5.2 1.6 1.6 3.9 2.3 5.2 1 1.3-1 1-3.3-.7-5.2-1.6-1.6-3.9-2.3-5.2-1zm-10.8-8.1c-.7 1.3.3 2.9 2.3 3.9 1.6 1 3.6.7 4.3-.7.7-1.3-.3-2.9-2.3-3.9-2-.6-3.6-.3-4.3.7zm32.4 35.6c-1.6 1.3-1 4.3 1.3 6.2 2.3 2.3 5.2 2.6 6.5 1 1.3-1.3.7-4.3-1.3-6.2-2.2-2.3-5.2-2.6-6.5-1zm-11.4-14.7c-1.6 1-1.6 3.6 0 5.9 1.6 2.3 4.3 3.3 5.6 2.3 1.6-1.3 1.6-3.9 0-6.2-1.4-2.3-4-3.3-5.6-2z"></path></svg>
                            </a>
                        </strong>
                    </li>
                    <li>
                        <strong>
                            <a href="https://riversand.atlassian.net/wiki/spaces/RCEC/pages/1106378810/UoM+Migration+Tool+Guidelines" target="_blank">Confluence 
                                <svg aria-hidden="true" width="20px" height="20px" focusable="false" data-prefix="fab" data-icon="confluence" class="svg-inline--fa fa-confluence fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M2.3 412.2c-4.5 7.6-2.1 17.5 5.5 22.2l105.9 65.2c7.7 4.7 17.7 2.4 22.4-5.3 0-.1.1-.2.1-.2 67.1-112.2 80.5-95.9 280.9-.7 8.1 3.9 17.8.4 21.7-7.7.1-.1.1-.3.2-.4l50.4-114.1c3.6-8.1-.1-17.6-8.1-21.3-22.2-10.4-66.2-31.2-105.9-50.3C127.5 179 44.6 345.3 2.3 412.2zm507.4-312.1c4.5-7.6 2.1-17.5-5.5-22.2L398.4 12.8c-7.5-5-17.6-3.1-22.6 4.4-.2.3-.4.6-.6 1-67.3 112.6-81.1 95.6-280.6.9-8.1-3.9-17.8-.4-21.7 7.7-.1.1-.1.3-.2.4L22.2 141.3c-3.6 8.1.1 17.6 8.1 21.3 22.2 10.4 66.3 31.2 106 50.4 248 120 330.8-45.4 373.4-112.9z"></path></svg>
                            </a>
                        </strong>
                    </li>
                </ul>
        </div>

        <br>

        <div class="row">
            <div class="offset-4">
                <button class="btn  btn-outline-info">
                <a href="<?php echo $server?>admin/otut/resources/uom-migration/UomMigration Tool.zip" style="text-decoration:none" download>Uom Migration Tool
                    <svg width="20px" height="20px" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="download" class="svg-inline--fa fa-download fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M216 0h80c13.3 0 24 10.7 24 24v168h87.7c17.8 0 26.7 21.5 14.1 34.1L269.7 378.3c-7.5 7.5-19.8 7.5-27.3 0L90.1 226.1c-12.6-12.6-3.7-34.1 14.1-34.1H192V24c0-13.3 10.7-24 24-24zm296 376v112c0 13.3-10.7 24-24 24H24c-13.3 0-24-10.7-24-24V376c0-13.3 10.7-24 24-24h146.7l49 49c20.1 20.1 52.5 20.1 72.6 0l49-49H488c13.3 0 24 10.7 24 24zm-124 88c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20zm64 0c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20z"></path></svg>
                </a>
                </button>
            </div>
        </div>

        <div class="row">
            <strong>Note : </strong>
            <ul>
                <li>Make  sure you are aware of the steps to use the tool since the tool is in command line interface.</li>
                <li >All the steps are clearly mentioned in the <a style="color: blue;" href="https://riversand.atlassian.net/wiki/spaces/RCEC/pages/1106378810/UoM+Migration+Tool+Guidelines" target="_blank">confluence page</a> for which you can find link above.</li>
                <li>You can find a <a style="color: blue;" href="<?php echo $server?>admin/otut/resources/uom-migration/UomMigration Tool.zip" target="_blank">downloadable</a> format of the zip file which contains the tool and configurable json file which has to be configured prior to starting the tool using bat file</li>
            </ul>
        </div>

    </div>

</section>
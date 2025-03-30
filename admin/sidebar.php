<!--begin:Menu item-->
<div class="menu-item">
    <!--begin:Menu link-->
    <div class="menu-item pt-5">
        <!--begin:Menu content-->
        <div class="menu-content">
            <span class="menu-heading fw-bold text-uppercase fs-7">Admin</span>
        </div>
        <!--end:Menu content-->
    </div>
    <div data-kt-menu-trigger="click" class="menu-item menu-accordion hover show">
        <span class="menu-link">
            <span class="menu-icon">
                <i class="ki-duotone ki-address-book fs-2">
                    <span class="path1"></span>
                    <span class="path2"></span>
                    <span class="path3"></span>
                </i>
            </span>
            <span class="menu-title">Student</span>
            <span class="menu-arrow"></span>
        </span>
        <div class="menu-sub menu-sub-accordion show" kt-hidden-height="250" style="">
            <div class="menu-item">
                <a class="menu-link" href="?page=student">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">Information</span>
                </a>
            </div>
        </div>
    </div>
    <div data-kt-menu-trigger="click" class="menu-item menu-accordion show">
        <span class="menu-link">
            <span class="menu-icon">
                <i class="ki-duotone ki-gear fs-2">
                    <span class="path1"></span>
                    <span class="path2"></span>
                    <span class="path3"></span>
                </i>
            </span>
            <span class="menu-title">Manage</span>
            <span class="menu-arrow"></span>
        </span>
        <div class="menu-sub menu-sub-accordion" kt-hidden-height="250" style="">
            <div class="menu-item">
                <a class="menu-link" href="?page=offices">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">Offices</span>
                </a>
            </div>
            <div class="menu-item">
                <a class="menu-link" href="?page=signatory">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">Signatory</span>
                </a>
            </div>
            <div class="menu-item">
                <a class="menu-link" href="?page=courses">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">Courses</span>
                </a>
            </div>
        </div>
    </div>
    <a class="menu-link" href="?page=setting">
        <span class="menu-icon">
            <i class="ki-duotone ki-security-user fs-2">
                <span class="path1"></span>
                <span class="path2"></span>
                <span class="path3"></span>
            </i>
        </span>
        <span class="menu-title">Profile</span>
    </a>
</div>
<!--end:Menu item-->

<!-- JavaScript for Active Highlight -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const links = document.querySelectorAll('.menu-link');
        const currentPage = window.location.search;

        links.forEach(link => {
            if (link.getAttribute('href') === currentPage) {
                link.classList.add('active');
                const parentAccordion = link.closest('.menu-accordion');
                if (parentAccordion) {
                    parentAccordion.classList.add('show');
                }
            }
        });
    });
</script>

<!-- CSS for Active Highlight -->
<style>
    .menu-link.active {
        background-color: #f3f6f9;
        color: #009ef7;
        font-weight: bold;
        border-left: 3px solid #009ef7;
    }
</style>

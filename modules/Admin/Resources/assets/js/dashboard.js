import Chart from "chart.js/auto";

class Dashboard {
    constructor() {
        // --- DỮ LIỆU MẪU (Giống Seeder Data) ---
        this.sampleData = {
            productPrices: [
                { name: 'Seeder Laptop Pro', price: 1350.00, formatted_price: '$1,350.00' },
                { name: 'Seeder Phone X', price: 999.50, formatted_price: '$999.50' },
                { name: 'Seeder Tablet A', price: 420.00, formatted_price: '$420.00' },
                { name: 'Seeder Watch 5', price: 299.00, formatted_price: '$299.00' },
                { name: 'Seeder Buds Lite', price: 75.99, formatted_price: '$75.99' },
            ],
            latestProducts: [
                { id: 1, name: 'Seeder Product Alpha', sku: 'ALP001', formatted_price: '$199.99', status_text: 'Active', status_class: 'active' },
                { id: 2, name: 'Seeder Product Beta', sku: 'BET002', formatted_price: '$49.50', status_text: 'Inactive', status_class: 'inactive' },
                { id: 3, name: 'Seeder Product Gamma', sku: 'GAM003', formatted_price: '$89.00', status_text: 'Active', status_class: 'active' },
                { id: 4, name: 'Seeder Product Delta', sku: 'DEL004', formatted_price: '$12.00', status_text: 'Active', status_class: 'active' },
                { id: 5, name: 'Seeder Product Epsilon', sku: 'EPS005', formatted_price: '$550.00', status_text: 'Inactive', status_class: 'inactive' },
            ],
            latestBrands: [
                { id: 1, name: 'Seeder Brand A', products_count: 15, status_text: 'Enabled', status_class: 'enabled' },
                { id: 2, name: 'Seeder Brand B', products_count: 8, status_text: 'Enabled', status_class: 'enabled' },
                { id: 3, name: 'Seeder Brand C', products_count: 22, status_text: 'Disabled', status_class: 'disabled' },
                { id: 4, name: 'Seeder Brand D', products_count: 5, status_text: 'Enabled', status_class: 'enabled' },
            ],
            latestUsers: [
                { id: 1, full_name: 'Alice Seeder', email: 'alice.s@example.com', role_text: 'Administrator' },
                { id: 2, full_name: 'Bob Seeder', email: 'bob.s@example.com', role_text: 'Member' },
                { id: 3, full_name: 'Charlie Seeder', email: 'charlie.s@example.com', role_text: 'Member' },
                { id: 4, full_name: 'David Seeder', email: 'david.s@example.com', role_text: 'Member' },
            ]
        };
        // --- Kết thúc dữ liệu mẫu ---

        this.apiEndpoints = {
            productPrices: '/admin/api/dashboard/product-prices',
            latestProducts: '/admin/api/dashboard/latest-products',
            latestBrands: '/admin/api/dashboard/latest-brands',
            latestUsers: '/admin/api/dashboard/latest-users',
            stats: '/admin/api/dashboard/stats'
        };

        this.routes = {
            products: '/admin/products',
            brands: '/admin/brands',
            users: '/admin/users'
        };

        this.initComponents();
    }

    initComponents() {
        this.fetchData();
    }

    // Fetch data from API endpoints
    fetchData() {
        this.initStatCards(); // Initialize with default values first
        this.fetchProductPriceData();
        this.fetchLatestProducts();
        this.fetchLatestBrands();
        this.fetchLatestUsers();
        this.fetchDashboardStats();
    }

    // Fetch dashboard stats
    fetchDashboardStats() {
        $.ajax({
            url: this.apiEndpoints.stats,
            method: 'GET',
            success: (response) => {
                if (response && response.data) {
                    this.updateStatCards(response.data);
                }
            },
            error: (error) => {
                console.error('Error fetching dashboard stats:', error);
            }
        });
    }

    // Fetch product price data
    fetchProductPriceData() {
        $.ajax({
            url: this.apiEndpoints.productPrices,
            method: 'GET',
            success: (response) => {
                if (response && response.data && response.data.length > 0) {
                    const chartData = {
                        labels: response.data.map(p => p.name),
                        prices: response.data.map(p => p.price),
                        formattedPrices: response.data.map(p => p.formatted_price),
                    };
                    this.initProductPriceChart(chartData);
                } else {
                    // Fallback to sample data if API returns no data
                    this.loadProductPriceChart();
                }
            },
            error: (error) => {
                console.error('Error fetching product price data:', error);
                // Fallback to sample data on error
                this.loadProductPriceChart();
            }
        });
    }

    // Fetch latest products
    fetchLatestProducts() {
        $.ajax({
            url: this.apiEndpoints.latestProducts,
            method: 'GET',
            success: (response) => {
                if (response && response.data && response.data.length > 0) {
                    this.renderLatestProducts(response.data);
                } else {
                    // Fallback to sample data if API returns no data
                    this.renderLatestProducts(this.sampleData.latestProducts);
                }
            },
            error: (error) => {
                console.error('Error fetching latest products:', error);
                // Fallback to sample data on error
                this.renderLatestProducts(this.sampleData.latestProducts);
            }
        });
    }

    // Fetch latest brands
    fetchLatestBrands() {
        $.ajax({
            url: this.apiEndpoints.latestBrands,
            method: 'GET',
            success: (response) => {
                if (response && response.data && response.data.length > 0) {
                    this.renderLatestBrands(response.data);
                } else {
                    // Fallback to sample data if API returns no data
                    this.renderLatestBrands(this.sampleData.latestBrands);
                }
            },
            error: (error) => {
                console.error('Error fetching latest brands:', error);
                // Fallback to sample data on error
                this.renderLatestBrands(this.sampleData.latestBrands);
            }
        });
    }

    // Fetch latest users
    fetchLatestUsers() {
        $.ajax({
            url: this.apiEndpoints.latestUsers,
            method: 'GET',
            success: (response) => {
                if (response && response.data && response.data.length > 0) {
                    this.renderLatestUsers(response.data);
                } else {
                    // Fallback to sample data if API returns no data
                    this.renderLatestUsers(this.sampleData.latestUsers);
                }
            },
            error: (error) => {
                console.error('Error fetching latest users:', error);
                // Fallback to sample data on error
                this.renderLatestUsers(this.sampleData.latestUsers);
            }
        });
    }

    // Khởi tạo các thẻ thống kê
    initStatCards() {
        this.updateStatCards({
            totalSales: '71.09K',
            totalOrders: '46',
            totalProducts: '140',
            totalCustomers: '4'
        });
    }

    // Cập nhật giá trị cho các thẻ thống kê
    updateStatCards(data) {
        if (data.totalSales) $('#total-sales').text(data.totalSales);
        if (data.totalOrders) $('#total-orders').text(data.totalOrders);
        if (data.totalProducts) $('#total-products').text(data.totalProducts);
        if (data.totalCustomers) $('#total-customers').text(data.totalCustomers);
    }

    // --- 1. Biểu đồ giá sản phẩm ---
    loadProductPriceChart() {
        let chartData = {
            labels: this.sampleData.productPrices.map(p => p.name),
            prices: this.sampleData.productPrices.map(p => p.price),
            formattedPrices: this.sampleData.productPrices.map(p => p.formatted_price),
        };
        this.initProductPriceChart(chartData);
    }

    // Khởi tạo biểu đồ giá sản phẩm
    initProductPriceChart(data) {
        if (!data || !data.labels || data.labels.length === 0) {
             console.warn("No data provided for product price chart.");
             const canvas = $(".product-price-chart .chart").get(0);
             if (canvas) {
                 const ctx = canvas.getContext('2d');
                 ctx.clearRect(0, 0, canvas.width, canvas.height);
                 ctx.textAlign = 'center';
                 ctx.fillText('No product price data available.', canvas.width / 2, canvas.height / 2);
             }
             return;
         }

        new Chart($(".product-price-chart .chart"), {
        type: "bar",
        data: {
            labels: data.labels,
            datasets: [
                {
                        label: 'Price',
                        data: data.prices,
                    borderRadius: 6,
                    backgroundColor: [
                        "rgba(76, 201, 254, .7)",
                        "rgba(71, 90, 255, .7)",
                        "rgba(255, 119, 183, .7)",
                        "rgba(250, 64, 50, .7)",
                        "rgba(136, 194, 115, .7)",
                        "rgba(139, 93, 255, .7)",
                        "rgba(255, 127, 62, .7)",
                    ],
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                    legend: {
                        display: false
                    },
                tooltip: {
                    displayColors: false,
                    callbacks: {
                            label: (item) => {
                                return `${data.labels[item.dataIndex]}: ${data.formattedPrices[item.dataIndex]}`;
                        },
                    },
                },
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                            callback: function(value) {
                                const currencySymbol = data.formattedPrices[0] ? data.formattedPrices[0].charAt(0) : '$';
                                return currencySymbol + value;
                            },
                        },
                    },
                    x: {
                        ticks: {
                        }
                    }
                },
            },
        });
    }

    // --- 2. Sản phẩm mới nhất ---
    loadLatestProducts() {
        this.renderLatestProducts(this.sampleData.latestProducts);
    }

    // Hiển thị dữ liệu sản phẩm mới nhất
    renderLatestProducts(products) {
        const $tableBody = $('#latest-products-table tbody');
        $tableBody.empty();

        if (!products || products.length === 0) {
            $tableBody.append(`<tr><td colspan="4" class="text-center no-data">No products available!</td></tr>`);
            return;
        }

        products.forEach(product => {
            const statusClass = product.status_class ||
                (product.status && product.status.toLowerCase() === 'active' ? 'active' :
                product.status && product.status.toLowerCase() === 'pending' ? 'pending' :
                product.status && product.status.toLowerCase().includes('pending payment') ? 'pending-payment' : 'default');

            const statusText = product.status_text || product.status || 'N/A';

            const $row = $(`
                <tr data-id="${product.id}">
                    <td>${product.name}</td>
                    <td>${product.sku}</td>
                    <td>${product.formatted_price || product.price}</td>
                    <td><span class="status-badge ${statusClass}">${statusText}</span></td>
                </tr>
            `);

            // Add click handler to redirect to products index page
            $row.on('click', () => {
                window.location.href = this.routes.products;
            });

            $tableBody.append($row);
        });
    }

    // --- 3. Thương hiệu mới nhất ---
    loadLatestBrands() {
        this.renderLatestBrands(this.sampleData.latestBrands);
    }

    // Hiển thị dữ liệu thương hiệu
    renderLatestBrands(brands) {
        const $tableBody = $('#latest-brands-table tbody');
        $tableBody.empty();

        if (!brands || brands.length === 0) {
             $tableBody.append(`<tr><td colspan="3" class="text-center no-data">No brands available!</td></tr>`);
            return;
        }

        brands.forEach(brand => {
            const statusClass = brand.status_class ||
                (brand.status && brand.status.toLowerCase() === 'enabled' ? 'enabled' :
                brand.status && brand.status.toLowerCase() === 'pending' ? 'pending' :
                brand.status && brand.status.toLowerCase().includes('pending payment') ? 'pending-payment' : 'default');

            const statusText = brand.status_text || brand.status || 'N/A';

            const $row = $(`
                <tr data-id="${brand.id}">
                    <td>${brand.name}</td>
                    <td>${brand.products_count}</td>
                    <td><span class="status-badge ${statusClass}">${statusText}</span></td>
                </tr>
            `);

            // Add click handler to redirect to brands index page
            $row.on('click', () => {
                window.location.href = this.routes.brands;
            });

            $tableBody.append($row);
        });
    }

    // --- 4. Người dùng mới nhất ---
    loadLatestUsers() {
        this.renderLatestUsers(this.sampleData.latestUsers);
    }

    // Hiển thị dữ liệu người dùng mới nhất
    renderLatestUsers(users) {
        const $tableBody = $('#latest-users-table tbody');
        $tableBody.empty();

        if (!users || users.length === 0) {
            $tableBody.append(`<tr><td colspan="3" class="text-center no-data">No users available!</td></tr>`);
            return;
        }

        users.forEach(user => {
            const roleClass = user.role_text && user.role_text.toLowerCase() === 'administrator' ? 'role-admin' : 'role-member';

            const $row = $(`
                <tr data-id="${user.id}">
                    <td>${user.full_name}</td>
                    <td>${user.email}</td>
                    <td><span class="status-badge ${roleClass}">${user.role_text}</span></td>
                </tr>
            `);

            // Add click handler to redirect to users index page
            $row.on('click', () => {
                window.location.href = this.routes.users;
            });

            $tableBody.append($row);
        });
    }
}

// Khởi tạo Dashboard khi trang đã tải xong
$(function() {
    window.dashboard = new Dashboard();
});

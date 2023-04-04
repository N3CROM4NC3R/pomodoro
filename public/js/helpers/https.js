export default async function POST(url, params) {
    const res = await axios.post(url, params);
    return res.data;
}

export async function GET(url) {
    console.log("Hello");
    const res = await axios.get(url);
    console.log(res.data);
    return res.data;
}

export async function DELETE(url, params) {
    console.log(params);
    const res = await axios.delete(url, params);
    return res.data;
}

export async function PUT(url, params) {
    const res = await axios.put(url, params);
    return res.data;
}

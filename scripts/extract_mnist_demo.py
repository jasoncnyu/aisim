import argparse
import random
from pathlib import Path

import numpy as np
from PIL import Image
from sklearn.datasets import fetch_openml, load_digits


def load_from_npz(path: Path):
    data = np.load(path)
    if "x_train" in data and "y_train" in data:
        x = data["x_train"]
        y = data["y_train"]
    elif "X" in data and "y" in data:
        x = data["X"]
        y = data["y"]
    else:
        raise ValueError("Unsupported npz format")

    if x.ndim == 3:
        x = x.reshape((-1, x.shape[1], x.shape[2]))
    elif x.ndim == 2 and x.shape[1] == 784:
        x = x.reshape((-1, 28, 28))
    else:
        raise ValueError("Unsupported image shape in npz")

    y = y.astype(int)
    return x.astype(np.uint8), y, "npz"


def load_from_openml(data_home: Path):
    data_home.mkdir(parents=True, exist_ok=True)
    mnist = fetch_openml("mnist_784", version=1, as_frame=False, data_home=str(data_home))
    x = mnist.data.reshape((-1, 28, 28)).astype(np.uint8)
    y = mnist.target.astype(int)
    return x, y, "openml"


def load_fallback_digits():
    digits = load_digits()
    x8 = digits.images
    y = digits.target.astype(int)

    x = np.zeros((x8.shape[0], 28, 28), dtype=np.uint8)
    for i in range(x8.shape[0]):
        arr = (x8[i] / 16.0 * 255.0).astype(np.uint8)
        img = Image.fromarray(arr, mode="L").resize((28, 28), resample=Image.Resampling.BILINEAR)
        x[i] = np.array(img, dtype=np.uint8)

    return x, y, "sklearn_digits_fallback"


def save_samples(x, y, out_dir: Path, per_class: int, seed: int):
    rng = random.Random(seed)
    out_dir.mkdir(parents=True, exist_ok=True)

    saved = {}
    for label in range(10):
        label_dir = out_dir / str(label)
        label_dir.mkdir(parents=True, exist_ok=True)

        idx = np.where(y == label)[0].tolist()
        if not idx:
            saved[label] = 0
            continue

        rng.shuffle(idx)
        take = idx[: min(per_class, len(idx))]
        for n, i in enumerate(take, start=1):
            img = Image.fromarray(x[i], mode="L")
            img.save(label_dir / f"{label}_{n:03d}.png")
        saved[label] = len(take)

    return saved


def main():
    parser = argparse.ArgumentParser(description="Extract MNIST-like demo images per class")
    parser.add_argument("--out", default="public/assets/demo/cnn_mnist", help="output directory")
    parser.add_argument("--per-class", type=int, default=50, help="images per class")
    parser.add_argument("--seed", type=int, default=42, help="random seed")
    parser.add_argument("--mnist-npz", default="", help="optional local mnist npz path")
    args = parser.parse_args()

    out_dir = Path(args.out)

    try:
        if args.mnist_npz:
            x, y, source = load_from_npz(Path(args.mnist_npz))
        elif Path("mnist.npz").exists():
            x, y, source = load_from_npz(Path("mnist.npz"))
        else:
            x, y, source = load_from_openml(Path(".sklearn_data"))
    except Exception as e:
        print(f"[warn] Could not load MNIST via npz/openml: {e}")
        x, y, source = load_fallback_digits()

    saved = save_samples(x, y, out_dir, args.per_class, args.seed)
    print(f"[ok] Source: {source}")
    for label in range(10):
        print(f"class {label}: {saved[label]} images")
    print(f"[ok] Output: {out_dir}")


if __name__ == "__main__":
    main()
